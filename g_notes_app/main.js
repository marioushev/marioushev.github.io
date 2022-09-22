//import notesAPI from "./notesAPI.js";
//notesAPI.deleteNote(143329);
//console.log(notesAPI.getAllNotes());
//import notesView from "./notesView.js";

import App from "./App.js";

const root = document.getElementById("app");
const app = new App(root);

/*
const view = new notesView(app, {
  onNoteAdd() {
    console.log("You're adding a new note!");
  },
  onNoteSelect(id) {
    console.log("Note Selected:" + id);
  },
  onNoteDelete(id) {
    console.log("Note Deleted:" + id);
  },
  onNoteEdit(newTitle, newBody) {
    console.log(newTitle);
    console.log(newBody);
  },
});

const notes = notesAPI.getAllNotes();
view.updateNoteList(notes);
view.updateActiveNote(notes[0]);
*/
