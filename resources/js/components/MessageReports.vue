<template>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="container mt-4">
        <h2 class="text-center">Message Reports</h2>



        <!-- department table List -->
        <div class="container mb-4">
            <!-- <h3 class="mt-4">Departments List</h3> -->
            <table data-bs-theme="" class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sender_ID</th>
                        <!-- <th>Department</th> -->
                        <th>Group</th>
                        <th>Message Content</th>
                      
                        <th>Actions</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="message in paginatedMessages" :key="message.id">
                        <td>{{ message.id }}</td>
                        <td>{{ message.sender_id }}</td>
                        <!-- <td>{{ message.group.department.name }}</td> -->
                        <td>{{ message.group.name }}</td>
                        <td class="message-cell">
                            <div class="message-content">{{ message.message_content }}</div></td>
                    
                        <td>
                            <button 
                                class="btn btn-success btn-sm me-2" @click="openViewModal(message)">
                                <i class="fa fa-eye"></i> View
                            </button>
                            <!-- <button style="" class="btn btn-secondary btn-sm me-2" @click="openEditModal(message)">
                                <i class="fa fa-edit"></i> Edit
                            </button> -->
                            <button  class="btn btn-danger btn-sm" @click="openDeleteModal(message)">
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




        <!-- View Modal -->
        <div data-bs-theme="dark" class="modal" tabindex="-1" v-if="viewModalOpen">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View Message</h5>
                        <button type="button" class="btn-close" @click="viewModalOpen = false"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Group:</strong> {{ selectedMessage.group.name }}</p>
                        <p class="message-content"><strong>Message Content:</strong> {{ selectedMessage.message_content}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="viewModalOpen = false">Close</button>
                    </div>
                </div>
            </div>
        </div>

   

        <!-- Delete Modal -->
        <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="deleteModalOpen">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Message</h5>
                        <button type="button" class="btn-close" @click="deleteModalOpen = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Message??</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteMessage">Delete</button>
                        <button type="button" class="btn btn-secondary" @click="deleteModalOpen = false">Cancel</button>
                    </div>
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
            groups: [], 
            messages: [],
            departments: [],
            selectedMessage: {},
            showSuccessModal: false,
            showFailModal: false,
            showUpdateSuccessModal: false,
            showDeleteSuccessModal: false,
            viewModalOpen: false,
            editModalOpen: false,
            deleteModalOpen: false,
            currentPage: 1,
            messagesPerPage: 20,
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.messages.length / this.messagesPerPage);
        },
        paginatedMessages() {
            const start = (this.currentPage - 1) * this.messagesPerPage;
            return this.messages.slice(start, start + this.messagesPerPage);
        },
    },
    methods: {
  //for fetching the departments from the database
        async fetchDepartments() {
            try {
                const response = await axios.get("/api/departments");
                this.departments = response.data;
            } catch (error) {
                console.error("Error fetching departments:", error);
            }
        },

         //for fetching the messages from the database
         async fetchMessages() {
            try {
                const response = await axios.get("/api/messages");
                this.messages = response.data;
            } catch (error) {
                console.error("Error fetching messages:", error);
            }
        },

        //for fetching the organisations to populate the drop down
        async fetchOrganisations() {
            try {
                const response = await axios.get("/api/organisations");
                this.organisations = response.data;
            } catch (error) {
                console.error("Error fetching organisations:", error);
            }
        },
//return the number of pages(pagination)
        changePage(page) {
            if (page < 1 || page > this.totalPages) return;
            this.currentPage = page;
        },

        //viewing modal
        openViewModal(message) {
            this.selectedMessage = { ...message };
            this.viewModalOpen = true;
        },
  //editing modal
        openEditModal(message) {
            this.selectedMessage = { ...message };
            this.editModalOpen = true;
        },
//updating modal
        async updateMessage() {
            try {
                await axios.put(`/api/message/${this.selectedMessage.id}`, this.selectedMessage);
                this.showUpdateSuccessModal = true;
                this.editModalOpen = false;
                this.fetchMessages();

                setTimeout(() => {
                    this.showUpdateSuccessModal = false;
                }, 10000); // 10 seconds

            } catch (error) {
                console.error("Error updating messages:", error);
            }
        },

        openDeleteModal(message) {
            this.selectedMessage = { ...message };
            this.deleteModalOpen = true;
        },
//delete modal
        async deleteMessage() {
            try {
                await axios.delete(`/api/message/${this.selectedMessage.id}`);
                this.showDeleteSuccessModal = true;
                this.deleteModalOpen = false;
                this.fetchMessages();

                setTimeout(() => {
                    this.showDeleteSuccessModal = false;
                }, 10000); // 10 seconds

            } catch (error) {
                console.error("Error deleting message:", error);
            }
        },
    },
    //POPuLATE THE SELECT DROP DOWN
    mounted() {
        this.fetchMessages();
        this.fetchDepartments();
        this.fetchOrganisations();
    },
};
</script>


<style scoped>
.modal {
    display: block;
    /* Ensure modals are displayed */
}
.message-cell{
    max-width: 200px;
}
/* for the message cell */
.message-content {
   max-height:100px;
    word-wrap: break-word; /*Wrap long words*/
    white-space: normal; /* Allow wrapping */
     /* text-align:justify;  */
    overflow-y: auto;

  }
</style>