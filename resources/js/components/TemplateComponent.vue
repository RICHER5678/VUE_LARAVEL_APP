<template>
    <div class="container mt-4">
        <h2 class="text-left">Template</h2>
        <form @submit.prevent="submitForm">
            <div class="row">
                <div class="col mb-3">
                    <label for="name" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" v-model="form.title" required />
                </div>
                <div class="col mb-3">
                    <label for="user_id" class="form-label">Created By</label>
                    <input type="number" class="form-control" id="user_id" v-model="form.user_id" required />
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-floating">
                        <textarea style="height:200px;" class="form-control" placeholder="Leave a comment here"
                            id="template_message" v-model="form.template_message"></textarea>
                        <label for="template_message">Enter your message here!</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Create&nbsp;<i class="fa fa-plus-circle"></i></button>
        </form>


        <!-- Success Modal for Form Submission -->
        <div class="modal text-light" tabindex="-1" v-if="showSuccessModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Success</h5>
                        <button type="button" class="btn-close" @click="showSuccessModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Template created successfully!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showSuccessModal = false">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Other modals (failure, update, delete) -->
        <!-- Update, Delete, and View modals follow the same structure as the success modal. -->
        <!-- Fail Modal for Form Submission -->
        <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showFailModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">Failure!</h5>
                        <button type="button" class="btn-close" @click="showFailModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Error Creating Template</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showFailModal = false">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Success Modal forUpdate -->
        <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showUpdateSuccessModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Success</h5>
                        <button type="button" class="btn-close" @click="showUpdateSuccessModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Template updated successfully!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            @click="showUpdateSuccessModal = false">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Success Modal for  Delete -->
        <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showDeleteSuccessModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Success</h5>
                        <button type="button" class="btn-close" @click="showDeleteSuccessModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Template deleted successfully!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            @click="showDeleteSuccessModal = false">Close</button>
                    </div>
                </div>
            </div>
        </div>






















        <!-- View Modal -->
        <div data-bs-theme="dark" class="modal" tabindex="-1" v-if="viewModalOpen">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View Template</h5>
                        <button type="button" class="btn-close" @click="viewModalOpen = false"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> {{ selectedTemplate.title }}</p>
                        <p><strong>Created By:</strong> {{ selectedTemplate.user.name }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="viewModalOpen = false">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Edit Modal -->
        <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="editModalOpen">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Template</h5>
                        <button type="button" class="btn-close" @click="editModalOpen = false"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" class="form-control" v-model="selectedTemplate.title" />
                            <label for="name" class="form-label">Template Message</label>
                            <input type="text" class="form-control" v-model="selectedTemplate.template_message" />
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="updateTemplate">Save Changes</button>
                        <button type="button" class="btn btn-secondary" @click="editModalOpen = false">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Delete Modal -->
        <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="deleteModalOpen">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Template</h5>
                        <button type="button" class="btn-close" @click="deleteModalOpen = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Template?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteTemplate">Delete</button>
                        <button type="button" class="btn btn-secondary" @click="deleteModalOpen = false">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="container mb-4">
            <h3 class="mt-4">Tempates</h3>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Created By</th>
                        <th>Template Body</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="template in paginatedTemplates" :key="template.id">
                        <td>{{ template.id }}</td>
                        <td>{{ template.title }}</td>
                        <td>{{ template.user.name }}</td>
                        <td>{{ template.template_message }}</td>
                        <td>{{ template.created_at }}</td>
                        <td>
                            <button class="btn btn-success btn-sm me-2" @click="openViewModal(template)">
                                <i class="fa fa-eye"></i> View
                            </button>
                            <button class="btn btn-secondary btn-sm me-2" @click="openEditModal(template)">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm" @click="openDeleteModal(template)">
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
                    <li class="page-item" v-for="page in totalPages" :key="page"
                        :class="{ active: page === currentPage }">
                        <button class="page-link" @click="changePage(page)">{{ page }}</button>
                    </li>
                    <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                        <button class="page-link" @click="changePage(currentPage + 1)">Next</button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>


<script>
import axios from "axios";


export default {
    data() {
        return {
            form: {
                title: "",
                user_id: "",
                template_message: ""
            },
            templates: [],
            selectedTemplate: {},
            showSuccessModal: false,
            showFailModal: false,
            showUpdateSuccessModal: false,
            showDeleteSuccessModal: false,
            viewModalOpen: false,
            editModalOpen: false,
            deleteModalOpen: false,
            currentPage: 1,
            templatesPerPage: 20,
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.templates.length / this.templatesPerPage);
        },
        paginatedTemplates() {
            const start = (this.currentPage - 1) * this.templatesPerPage;
            return this.templates.slice(start, start + this.templatesPerPage);
        },
    },
    methods: {
        async submitForm() {
            try {
                await axios.post("/api/template", this.form);
                this.showSuccessModal = true;
                this.form = { title: "", user_id: "", template_message: "" };
                this.fetchTemplates();
                setTimeout(() => { this.showSuccessModal = false; }, 10000);
            } catch (error) {
                this.showFailModal = true;
                setTimeout(() => { this.showFailModal = false; }, 10000);
            }
        },


        async fetchTemplates() {
            try {
                const response = await axios.get("/api/templates");
                this.templates = response.data;
            } catch (error) {
                console.error("Error fetching templates:", error);
            }
        },


        changePage(page) {
            if (page < 1 || page > this.totalPages) return;
            this.currentPage = page;
        },


        openViewModal(template) {
            this.selectedTemplate = { ...template };
            this.viewModalOpen = true;
        },


        openEditModal(template) {
            this.selectedTemplate = { ...template };
            this.editModalOpen = true;
        },


        async updateTemplate() {
            try {
                await axios.put(`/api/template/${this.selectedTemplate.id}`, this.selectedTemplate);
                this.showUpdateSuccessModal = true;
                this.editModalOpen = false;
                this.fetchTemplates();
                setTimeout(() => { this.showUpdateSuccessModal = false; }, 10000);
            } catch (error) {
                console.error("Error updating template:", error);
            }
        },


        openDeleteModal(template) {
            this.selectedTemplate = { ...template };
            this.deleteModalOpen = true;
        },


        async deleteTemplate() {
            try {
                await axios.delete(`/api/template/${this.selectedTemplate.id}`);
                this.showDeleteSuccessModal = true;
                this.deleteModalOpen = false;
                this.fetchTemplates();
                setTimeout(() => { this.showDeleteSuccessModal = false; }, 10000);
            } catch (error) {
                console.error("Error deleting template:", error);
            }
        },
    },
    mounted() {
        this.fetchTemplates();
    }
};
</script>
<style scoped>
.modal {
    display: block;
    /* ensure to display the modals */
}
</style>