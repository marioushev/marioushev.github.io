//import notesAPI from "./notesAPI.js";
//notesAPI.deleteNote(143329);
//console.log(notesAPI.getAllNotes());
//import notesView from "./notesView.js";

// Import the App class from the App.js file
import App from "./App.js";

// Get the DOM element with the id "app"
const root = document.getElementById("app");

// Create a new instance of the App class, passing the root element
const app = new App(root);

// This code initializes the notes application:
// 1. It imports the main App class.
// 2. It finds the root element where the app will be rendered.
// 3. It creates a new App instance, which sets up the entire application
//    including the view, event handlers, and initial data loading.

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
