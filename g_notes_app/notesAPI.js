export default class notesAPI {
  static getAllNotes() {
    const notes = JSON.parse(localStorage.getItem("notesapp-notes") || "[]");
    return notes.sort((a, b) => {
      return new Date(a.lastUpdate) > new Date(b.lastUpdate) ? -1 : 1;
    });
  }
  static saveNotes(notesToSave) {
    const notes = notesAPI.getAllNotes();
    const existing = notes.find((note) => note.id == notesToSave.id);

    if (existing) {
      existing.title = notesToSave.title;
      existing.body = notesToSave.body;
      existing.lastUpdate = notesToSave.lastUpdate;
    } else {
      notesToSave.id = Math.floor(Math.random() * 1000000);
      notesToSave.lastUpdate = new Date().toISOString();
      notes.push(notesToSave);
    }

    localStorage.setItem("notesapp-notes", JSON.stringify(notes));
  }
  static deleteNote(id) {
    const notes = notesAPI.getAllNotes();
    const newNotes = notes.filter((note) => note.id != id);

    localStorage.setItem("notesapp-notes", JSON.stringify(newNotes));
  }
}
