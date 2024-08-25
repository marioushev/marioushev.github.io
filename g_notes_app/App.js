// This file contains the main App class that manages the notes application

// Import necessary modules
import notesView from "./notesView.js";
import notesAPI from "./notesAPI.js";

// Define the main App class
export default class App {
  // Constructor initializes the app with a root element
  constructor(root) {
    this.notes = []; // Array to store all notes
    this.activeNote = null; // Currently active note
    this.view = new notesView(root, this._handlers()); // Create view with event handlers

    this._refreshNotes(); // Load initial notes
  }

  // Private method to refresh notes from storage
  _refreshNotes() {
    const notes = notesAPI.getAllNotes(); // Get all notes from API
    this._setNotes(notes); // Update app state with fetched notes

    if (notes.length > 0) {
      this._setActiveNote(notes[0]); // Set first note as active if notes exist
    }
  }

  // Private method to update notes in the app and view
  _setNotes(notes) {
    this.notes = notes; // Update app's notes array
    this.view.updateNoteList(notes); // Update view's note list
    this.view.updateNotePreviewVisibility(notes.length > 0); // Show/hide note preview based on note existence
  }

  // Private method to set and display the active note
  _setActiveNote(note) {
    this.activeNote = note; // Set the active note in the app
    this.view.updateActiveNote(note); // Update the view to display the active note
  }

  // Private method that returns an object with event handlers
  _handlers() {
    return {
      // Handler for note selection
      onNoteSelect: (noteId) => {
        const selectedNote = this.notes.find((note) => note.id == noteId);
        this._setActiveNote(selectedNote);
        // TODO: Implement hover highlight removal
      },
      // Handler for note deletion
      onNoteDelete: (noteId) => {
        notesAPI.deleteNote(noteId); // Delete note from storage
        this._refreshNotes(); // Refresh notes to update view
      },
      // Handler for note editing
      onNoteEdit: (title, body) => {
        notesAPI.saveNotes({
          id: this.activeNote.id,
          title: title,
          body: body,
        }); // Save edited note
        this._refreshNotes(); // Refresh notes to update view
      },
      // Handler for adding a new note
      onNoteAdd: () => {
        const newNote = {
          title: "New Note",
          body: "You are taking a note of ....",
        };
        notesAPI.saveNotes(newNote); // Save new note
        this._refreshNotes(); // Refresh notes to update view
      },
    };
  }
}
