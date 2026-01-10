/*
export default class notesView {
  constructor(
    root,
    { onNoteSelect, onNoteAdd, onNoteEdit, onNoteDelete } = {}
  ) {
    this.root = root;
    this.onNoteSelect = onNoteSelect;
    this.onNoteAdd = onNoteAdd;
    this.onNoteEdit = onNoteEdit;
    this.onNoteDelete = onNoteDelete;
    this.root.innerHTML = `
        <div class="notes__sidebar">
            <button class="notes__add" type="button">Add Note</button>
            <div class="notes__list"></div>
        </div>
    <div class="notes__preview">
        <input
        class="notes__title"
        type="text"
        placeholder="New Note ..."
        />
        <textarea class="notes__body" placeholder="what are you thinking about?"></textarea>
    </div>`;

    const btnAddNote = this.root.querySelector(".notes__add");
    const inpTitle = this.root.querySelector(".notes__title");
    const inpBody = this.root.querySelector(".notes__body");

    btnAddNote.addEventListener("click", () => {
      this.onNoteAdd();
    });

    [inpTitle, inpBody].forEach((inputField) => {
      inputField.addEventListener("blur", () => {
        const updatedTitle = inpTitle.value.trim();
        const updatedBody = inpBody.value.trim();

        this.onNoteEdit(updatedTitle, updatedBody);
      });
    });

    // hide preview note by default
    this.updateNotePreviewVisibility(false);
  }

  _createListItemHTML(id, title, body, lastUpdate) {
    const MAX_BODY_LENGTH = 60;

    return `
    <div class="notes__list-item data-note-id="${id}">
        <div class="notes__small-title">${title}</div>
        <div class="notes__small-body">
            ${body.substring(0, MAX_BODY_LENGTH)}
            ${body.length > MAX_BODY_LENGTH ? "..." : ""}
        </div>
        <div class="notes__small-lastUpdate">${lastUpdate.toLocalString(
          undefined,
          { dateStyle: "full", timeStyle: "short" }
        )}</div>
    </div>
    `;
  }

  updateNoteList(notes) {
    const notesListContainer = this.root.querySelector("notes__list");

    // empty list
    notesListContainer.innerHTML = "";

    for (const note of notes) {
      const html = this._createListItemHTML(
        note.id,
        note.title,
        note.body,
        new Date(note.lastUpdate)
      );

      notesListContainer.insertAdjacentHTML("beforeend", html);
    }

    // add select/delete events for each list item
    notesListContainer
      .querySelectorAll(".notes__list-item")
      .forEach((notesListItem) => {
        notesListItem.addEventListener("click", () => {
          this.onNoteSelect(notesListItem.dataset.noteId); // noteID === note-id converts into camelCase
        });

        notesListItem.addEventListener("dbclick", () => {
          const doDelete = confirm(
            "Are you sure you want to delete this note?"
          );

          if (doDelete) {
            this.onNoteDelete(notesListItem.dataset.noteId);
          }
        });
      });
  }

  updateActiveNote(note) {
    this.root.querySelector(".notes__titles").value = note.title;
    this.root.querySelector(".notes__body").value = note.body;

    this.root.querySelectorAll(".notes__list-item").forEach((notesListItem) => {
      notesListItem.classList.remove("notes__list-item--selected");
    });

    this.root
      .querySelector(`.notes__list-item[data-note-id="${note.id}"`)
      .classList.add("notes__list-item--selected");
  }

  updateNotePreviewVisibility(visible) {
    this.root.querySelector(".notes__preview").style.visibility = visible
      ? "visible"
      : "hidden";
  }
}
*/

export default class notesView {
  // Constructor for the notesView class
  constructor(
    root,
    { onNoteSelect, onNoteAdd, onNoteEdit, onNoteDelete } = {}
  ) {
    // Store the root element and callback functions
    this.root = root;
    this.onNoteSelect = onNoteSelect;
    this.onNoteAdd = onNoteAdd;
    this.onNoteEdit = onNoteEdit;
    this.onNoteDelete = onNoteDelete;

    // Set up the initial HTML structure for the notes app
    this.root.innerHTML = `
          <div class="notes__sidebar">
              <button class="notes__add" type="button">Add Note</button>
              <div class="notes__list"></div>
          </div>
          <div class="notes__preview">
              <input class="notes__title" type="text" placeholder="New Note...">
              <textarea class="notes__body" placeholder="Take Note..."></textarea>
          </div>
      `;

    // Get references to important elements
    const btnAddNote = this.root.querySelector(".notes__add");
    const inpTitle = this.root.querySelector(".notes__title");
    const inpBody = this.root.querySelector(".notes__body");

    // Add event listener for adding a new note
    btnAddNote.addEventListener("click", () => {
      this.onNoteAdd();
    });

    // Add event listeners for editing note title and body
    [inpTitle, inpBody].forEach((inputField) => {
      inputField.addEventListener("blur", () => {
        const updatedTitle = inpTitle.value.trim();
        const updatedBody = inpBody.value.trim();
        this.onNoteEdit(updatedTitle, updatedBody);
      });
    });

    // Initially hide the note preview
    this.updateNotePreviewVisibility(false);
  }

  // Helper method to create HTML for a single note list item
  _createListItemHTML(id, title, body, lastUpdate) {
    const MAX_BODY_LENGTH = 60;

    return `
          <div class="notes__list-item" data-note-id="${id}">
              <div class="notes__small-title">${title}</div>
              <div class="notes__small-body">
                  ${body.substring(0, MAX_BODY_LENGTH)}
                  ${body.length > MAX_BODY_LENGTH ? "..." : ""}
              </div>
              <div class="notes__small-lastUpdate">
                  ${lastUpdate.toLocaleString(undefined, {
                    dateStyle: "full",
                    timeStyle: "short",
                  })}
              </div>
          </div>
      `;
  }

  // Method to update the list of notes in the sidebar
  updateNoteList(notes) {
    const notesListContainer = this.root.querySelector(".notes__list");
    notesListContainer.innerHTML = "";

    // Create and add HTML for each note
    for (const note of notes) {
      const html = this._createListItemHTML(
        note.id,
        note.title,
        note.body,
        new Date(note.lastUpdate)
      );
      notesListContainer.insertAdjacentHTML("beforeend", html);
    }

    // Add event listeners for selecting and deleting notes
    notesListContainer
      .querySelectorAll(".notes__list-item")
      .forEach((noteListItem) => {
        noteListItem.addEventListener("click", () => {
          this.onNoteSelect(noteListItem.dataset.noteId);
        });

        noteListItem.addEventListener("dblclick", () => {
          const doDelete = confirm(
            "Are you sure you want to delete this note?"
          );
          if (doDelete) {
            this.onNoteDelete(noteListItem.dataset.noteId);
          }
        });
      });
  }

  // Method to update the active note in the preview area
  updateActiveNote(note) {
    this.root.querySelector(".notes__title").value = note.title;
    this.root.querySelector(".notes__body").value = note.body;

    // Remove selection styling from all notes
    this.root.querySelectorAll(".notes__list-item").forEach((noteListItem) => {
      noteListItem.classList.remove("notes__list-item--selected");
    });

    // Add selection styling to the active note
    this.root
      .querySelector(`.notes__list-item[data-note-id="${note.id}"]`)
      .classList.add("notes__list-item--selected");
  }

  // Method to show or hide the note preview area
  updateNotePreviewVisibility(visible) {
    this.root.querySelector(".notes__preview").style.visibility = visible
      ? "visible"
      : "hidden";
  }
}
