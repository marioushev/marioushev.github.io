// This class provides an API for managing notes in local storage
export default class notesAPI {
  // Retrieves all notes from local storage and sorts them by last update
  static getAllNotes() {
    // Parse notes from local storage, defaulting to an empty array if none exist
    const notes = JSON.parse(localStorage.getItem("notesapp-notes") || "[]");
    // Sort notes by lastUpdate date in descending order
    return notes.sort((a, b) => {
      return new Date(a.lastUpdate) > new Date(b.lastUpdate) ? -1 : 1;
    });
  }

  // Saves a note to local storage, either updating an existing note or creating a new one
  static saveNotes(notesToSave) {
    const notes = notesAPI.getAllNotes();
    // Check if the note already exists
    const existing = notes.find((note) => note.id == notesToSave.id);

    if (existing) {
      // Update existing note
      existing.title = notesToSave.title;
      existing.body = notesToSave.body;
      existing.lastUpdate = notesToSave.lastUpdate;
    } else {
      // Create new note
      notesToSave.id = Math.floor(Math.random() * 1000000); // Generate random ID
      notesToSave.lastUpdate = new Date().toISOString(); // Set current timestamp
      notes.push(notesToSave);
    }

    // Save updated notes array back to local storage
    localStorage.setItem("notesapp-notes", JSON.stringify(notes));
  }

  // Deletes a note from local storage by its ID
  static deleteNote(id) {
    const notes = notesAPI.getAllNotes();
    // Filter out the note with the given ID
    const newNotes = notes.filter((note) => note.id != id);

    // Save the updated notes array back to local storage
    localStorage.setItem("notesapp-notes", JSON.stringify(newNotes));
  }
}
