<template  >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <div   class="container mt-4">
    <h2 class="text-center">Add Contact</h2>
    <form @submit.prevent="submitForm">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" v-model="form.name" required />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" v-model="form.email" required />
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="number" class="form-control" id="phone" v-model="form.phone" required />
      </div>
      <button type="submit" class="btn btn-success"> Add Contact&nbsp;<i class="fa fa-plus-circle"></i></button>
    </form>

    <!-- Success Modal for Form Submission -->
    <div  data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showSuccessModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Success</h5>
            <button type="button" class="btn-close" @click="showSuccessModal = false"></button>
          </div>
          <div class="modal-body">
            <p>Contact Created successfully!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showSuccessModal = false">Close</button>
          </div>
        </div>
      </div>
    </div>

      <!-- Fail Modal for Form Submission -->
      <div  data-bs-theme="dark" class="modal text-light " tabindex="-1" v-if="showFailModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header ">
            <h5 class="modal-title text-danger ">Failure!</h5>
            <button type="button" class="btn-close" @click="showFailModal = false"></button>
          </div>
          <div class="modal-body " >
            <p >Error Creating Contact!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showFailModal = false">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Success Modal for Contact Update -->
    <div  data-bs-theme="dark" class="modal text-light"  tabindex="-1" v-if="showUpdateSuccessModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Success</h5>
            <button type="button" class="btn-close" @click="showUpdateSuccessModal = false"></button>
          </div>
          <div class="modal-body">
            <p>Contact updated successfully!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showUpdateSuccessModal = false">Close</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Success Modal for Contact Delete -->
    <div  data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showDeleteSuccessModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Success</h5>
            <button type="button" class="btn-close" @click="showDeleteSuccessModal = false"></button>
          </div>
          <div class="modal-body">
            <p>Contact deleted successfully!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showDeleteSuccessModal = false">Close</button>
          </div>
        </div>
      </div>
    </div>



    <!-- for importing contacts -->
      <!-- Import Button with File Input -->
      <div class="float-end">
        <button class="btn btn-success " @click="importFile = null; showImportModal = true">
          <i class="fas fa-file-import"></i> Import Contacts
        </button>
      </div>
    
    
    <!-- Import Modal -->
    <div class="modal" v-if="showImportModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Import Contacts</h5>
            <button type="button" class="btn-close" @click="showImportModal = false"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submitImport">
              <div class="mb-3">
                <i class="fa fa-file-excel p-2" aria-hidden="true"></i>
                <label for="file" class="form-label">Select Excel or CSV File</label>
                <input type="file" class="form-control" id="file" @change="handleFileUpload" accept=".xlsx,.csv" required />
              </div>
              <button type="submit" class="btn btn-success">Import<i class="fa fa-arrow-circle-right p-2" aria-hidden="true"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
     <!-- for importing contacts -->

    <!-- Contact List -->
    <div class="container mb-4">
      <h3 class="mt-4">Contact List</h3>
      <table data-bs-theme="" class="table table-bordered mt-3  ">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="contact in paginatedContacts" :key="contact.id">
            <td>{{ contact.id }}</td>
            <td>{{ contact.name }}</td>
            <td>{{ contact.email }}</td>
            <td>{{ contact.phone }}</td>
            <td>
              <!-- Action buttons -->
              <button class="btn btn-success btn-sm me-2" @click="openViewModal(contact)">
                <i class="fa fa-eye"></i> View
              </button>
              <button class="btn btn-primary btn-sm me-2" @click="openEditModal(contact)">
                <i class="fa fa-edit"></i> Edit
              </button>
              <button class="btn btn-danger btn-sm" @click="openDeleteModal(contact)">
                <i class="fa fa-trash"></i> Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>

         <!-- Pagination Controls -->
         <nav>
        <ul class="pagination">
          <li class="page-item" :class="{ disabled: currentPage === 1 }">
            <button class="page-link" @click="changePage(currentPage - 1)">Previous</button>
          </li>
          <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: page === currentPage }">
            <button class="page-link" @click="changePage(page)">{{ page }}</button>
          </li>
          <li class="page-item" :class="{ disabled: currentPage === totalPages }">
            <button class="page-link" @click="changePage(currentPage + 1)">Next</button>
          </li>
        </ul>
      </nav>
    </div>

    <!-- View Modal -->
    <div  data-bs-theme="dark" class="modal" tabindex="-1" v-if="viewModalOpen">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">View Contact</h5>
            <button type="button" class="btn-close" @click="viewModalOpen = false"></button>
          </div>
          <div class="modal-body">
            <p><strong>Name:</strong> {{ selectedContact.name }}</p>
            <p><strong>Email:</strong> {{ selectedContact.email }}</p>
            <p><strong>Phone Number:</strong> {{ selectedContact.phone }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="viewModalOpen = false">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div  data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="editModalOpen">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Contact</h5>
            <button type="button" class="btn-close" @click="editModalOpen = false"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" v-model="selectedContact.name" />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label" >Email</label>
              <input  type="email" class="form-control" v-model="selectedContact.email" />
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="number" class="form-control" v-model="selectedContact.phone" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="updateContact">Save Changes</button>
            <button type="button" class="btn btn-secondary" @click="editModalOpen = false">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Modal -->
    <div  data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="deleteModalOpen">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Contact</h5>
            <button type="button" class="btn-close" @click="deleteModalOpen = false"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this contact?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="deleteContact">Delete</button>
            <button type="button" class="btn btn-secondary" @click="deleteModalOpen = false">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
      },
      contacts: [],
      selectedContact: {},
      showImportModal:false,
      showSuccessModal: false,
      showFailModal:false,
      showUpdateSuccessModal: false,
      showDeleteSuccessModal: false,
      viewModalOpen: false,
      editModalOpen: false,
      deleteModalOpen: false,
      currentPage: 1,
      contactsPerPage: 20,
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.contacts.length / this.contactsPerPage);
    },
    paginatedContacts() {
      const start = (this.currentPage - 1) * this.contactsPerPage;
      return this.contacts.slice(start, start + this.contactsPerPage);
    },
  },
  methods: {
    async submitForm() {
      try {
        await axios.post("/api/contact", this.form);
        this.showSuccessModal = true;
        this.form = { name: "", email: "", phone: "" };
        this.fetchContacts();

        //automatically hide the success modal after submittig the form
        setTimeout(() => {
      this.showSuccessModal = false;
    }, 10000); // 10 seconds

      } catch (error) {
        this.showFailModal = true;
        this.form = { name: "", email: "", phone: "" };
        console.error("Error submitting form:", error);

        //automatically hide the fail modal after submiting a form
        setTimeout(() => {
      this.showFailModal = false;
    }, 10000); // 10 seconds

      }
    },
    //for handling the imports  
    handleFileUpload(event) {
      this.importFile = event.target.files[0];  // Store the uploaded file
    },
    async submitImport() {
      const formData = new FormData();
      formData.append('file', this.importFile);

      try {
        await axios.post("/api/import-contacts", formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        this.showSuccessModal = true;
        this.showImportModal = false;
        this.fetchContacts();  // Reload contacts after import
//automatically hide the success modal after importing(10secs)
setTimeout(() => {
      this.showSuccessModal = false;
    }, 10000); // 10 seconds

      } catch (error) {
        console.error("Error importing contacts:", error);
        this.showImportModal = false;
        this.showFailModal = true;
        
        //automatically hide the fail modal after importing
        setTimeout(() => {
      this.showFailModal = false;
    }, 10000); // 10 seconds
      }
    },
    //for fetching the data fron the database
    async fetchContacts() {
      try {
        const response = await axios.get("/api/contacts");
        this.contacts = response.data;
       
      } catch (error) {
        console.error("Error fetching contacts:", error);
      }
    },
    changePage(page) {
      if (page < 1 || page > this.totalPages) return;
      this.currentPage = page;
    },
    openViewModal(contact) {
      this.selectedContact = { ...contact };
      this.viewModalOpen = true;
    },
    openEditModal(contact) {
      this.selectedContact = { ...contact };
      this.editModalOpen = true;
    },
    async updateContact() {
      try {
        await axios.put(`/api/contact/${this.selectedContact.id}`, this.selectedContact);
        this.showUpdateSuccessModal = true;
        this.editModalOpen = false;
        this.fetchContacts();

        //automatically make the update modal disapper after updating
        setTimeout(() => {
      this.showUpdateSuccessModal = false;
    }, 10000); // 10 seconds

      } catch (error) {
        console.error("Error updating contact:", error);
      }
    },
    openDeleteModal(contact) {
      this.selectedContact = { ...contact };
      this.deleteModalOpen = true;
    },
    async deleteContact() {
      try {
        await axios.delete(`/api/contact/${this.selectedContact.id}`);
        this.showDeleteSuccessModal = true;
        this.deleteModalOpen = false;
        this.fetchContacts();
        //automatically make the delete success modal disapper
        setTimeout(() => {
      this.showDeleteSuccessModal = false;
    }, 10000); // 10 seconds

      } catch (error) {
        console.error("Error deleting contact:", error);
      }
    },
  },
  created() {
    this.fetchContacts();
  },
};
</script>

<style scoped>
.modal {
  display: block; /* Ensure modals are displayed */
}
</style>
