// Step 1: Set up our audio context and variables
let audioContext;
let file1Buffer;
let file2Buffer;

// Step 2: Create a function to load our audio files
function loadAudioFile(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onload = async (event) => {
      try {
        const arrayBuffer = event.target.result;
        const audioBuffer = await audioContext.decodeAudioData(arrayBuffer);
        resolve(audioBuffer);
      } catch (error) {
        reject(error);
      }
    };
    reader.onerror = (error) => reject(error);
    reader.readAsArrayBuffer(file);
  });
}

// Step 3: Create a function to find the offset between two audio buffers
function findOffset(buffer1, buffer2) {
  const data1 = buffer1.getChannelData(0);
  const data2 = buffer2.getChannelData(0);
  let bestOffset = 0;
  let bestCorrelation = -1;
  const maxOffset = Math.abs(buffer1.length - buffer2.length);

  for (let offset = 0; offset <= maxOffset; offset++) {
    let correlation = 0;
    for (let i = 0; i < Math.min(data1.length, data2.length); i++) {
      correlation += Math.abs(data1[i] - data2[(i + offset) % data2.length]);
    }
    correlation = 1 - correlation / Math.min(data1.length, data2.length);
    if (correlation > bestCorrelation) {
      bestCorrelation = correlation;
      bestOffset = offset;
    }
  }

  return bestOffset;
}

// Step 4: Create a function to synchronize our audio buffers
function synchronizeAudio(buffer1, buffer2, offset) {
  const syncedLength = Math.max(buffer1.length, buffer2.length + offset);
  const syncedBuffer = audioContext.createBuffer(
    1,
    syncedLength,
    buffer1.sampleRate
  );

  const channel1 = buffer1.getChannelData(0);
  const channel2 = buffer2.getChannelData(0);
  const syncedChannel = syncedBuffer.getChannelData(0);

  for (let i = 0; i < syncedLength; i++) {
    if (i < buffer1.length) {
      syncedChannel[i] += channel1[i];
    }
    if (i >= offset && i < buffer2.length + offset) {
      syncedChannel[i] += channel2[i - offset];
    }
  }

  return syncedBuffer;
}

// Step 5: Set up our event listeners
document.addEventListener("DOMContentLoaded", () => {
  const syncButton = document.getElementById("syncButton");
  const file1Input = document.getElementById("file1");
  const file2Input = document.getElementById("file2");
  const outputAudio = document.getElementById("outputAudio");

  syncButton.addEventListener("click", async () => {
    if (!file1Input.files[0] || !file2Input.files[0]) {
      alert("Please select two audio files");
      return;
    }

    try {
      audioContext = new (window.AudioContext || window.webkitAudioContext)();

      file1Buffer = await loadAudioFile(file1Input.files[0]);
      file2Buffer = await loadAudioFile(file2Input.files[0]);

      const offset = findOffset(file1Buffer, file2Buffer);
      const syncedBuffer = synchronizeAudio(file1Buffer, file2Buffer, offset);

      const blob = bufferToWave(syncedBuffer, syncedBuffer.length);
      outputAudio.src = URL.createObjectURL(blob);
    } catch (error) {
      console.error("Error synchronizing audio:", error);
      alert("An error occurred while synchronizing the audio");
    }
  });
});

// Step 6: Helper function to convert AudioBuffer to WAV
function bufferToWave(abuffer, len) {
  const numOfChan = abuffer.numberOfChannels;
  const length = len * numOfChan * 2 + 44;
  const buffer = new ArrayBuffer(length);
  const view = new DataView(buffer);
  const channels = [];
  let i;
  let sample;
  let offset = 0;
  let pos = 0;

  // write WAVE header
  setUint32(0x46464952); // "RIFF"
  setUint32(length - 8); // file length - 8
  setUint32(0x45564157); // "WAVE"

  setUint32(0x20746d66); // "fmt " chunk
  setUint32(16); // length = 16
  setUint16(1); // PCM (uncompressed)
  setUint16(numOfChan);
  setUint32(abuffer.sampleRate);
  setUint32(abuffer.sampleRate * 2 * numOfChan); // avg. bytes/sec
  setUint16(numOfChan * 2); // block-align
  setUint16(16); // 16-bit (hardcoded in this demo)

  setUint32(0x61746164); // "data" - chunk
  setUint32(length - pos - 4); // chunk length

  // write interleaved data
  for (i = 0; i < abuffer.numberOfChannels; i++)
    channels.push(abuffer.getChannelData(i));

  while (pos < length) {
    for (i = 0; i < numOfChan; i++) {
      // interleave channels
      sample = Math.max(-1, Math.min(1, channels[i][offset])); // clamp
      sample = (0.5 + sample < 0 ? sample * 32768 : sample * 32767) | 0; // scale to 16-bit signed int
      view.setInt16(pos, sample, true); // update data chunk
      pos += 2;
    }
    offset++; // next source sample
  }

  // create Blob
  return new Blob([buffer], { type: "audio/wav" });

  function setUint16(data) {
    view.setUint16(pos, data, true);
    pos += 2;
  }

  function setUint32(data) {
    view.setUint32(pos, data, true);
    pos += 4;
  }
}
