<template>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="container mt-4">
        <h2 class="text-left">Department</h2>
        <form @submit.prevent="submitForm">
            <div class="row">
                <div class="col mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" v-model="form.name" required />
                </div>
                <div class=" col mb-3">
                    <label for="name" class="form-label">Organisation ID</label>
                    <input type="text" class="form-control" id="organisation_id"  v-model="form.organisation_id" required />
                </div>
            </div>
            <button type="submit" class="btn btn-success">Create&nbsp;<i class="fa fa-plus-circle"></i></button>
        </form>

        <!-- Success Modal for Form Submission -->
        <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showSuccessModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Success</h5>
                        <button type="button" class="btn-close" @click="showSuccessModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Department Created successfully!</p>
                        <p >
                            <p ><strong>Organisation:</strong> {{ selectedDepartment.organisation.name }}</p>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showSuccessModal = false">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fail Modal for Form Submission -->
        <div data-bs-theme="dark" class="modal text-light " tabindex="-1" v-if="showFailModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title text-danger ">Failure!</h5>
                        <button type="button" class="btn-close" @click="showFailModal = false"></button>
                    </div>
                    <div class="modal-body ">
                        <p>Error Creating Department!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showFailModal = false">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Modal for organisation Update -->
        <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showUpdateSuccessModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Success</h5>
                        <button type="button" class="btn-close" @click="showUpdateSuccessModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Department updated successfully!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            @click="showUpdateSuccessModal = false">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Success Modal for Contact Delete -->
        <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showDeleteSuccessModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Success</h5>
                        <button type="button" class="btn-close" @click="showDeleteSuccessModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Department deleted successfully!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            @click="showDeleteSuccessModal = false">Close</button>
                    </div>
                </div>
            </div>
        </div>







        <!-- Contact List -->
        <div class="container mb-4">
            <h3 class="mt-4">Departments List</h3>
            <table data-bs-theme="" class="table table-bordered mt-3  ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Organisation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="department in paginatedDepartments" :key="department.id">
                        <td>{{ department.id }}</td>
                        <td>{{ department.name }}</td>
                        <td>{{ department.organisation.name }}</td>
                        <td>
                            <!-- Action buttons -->
                            <button style="width:100px; margin-left:10px; margin-right: 0;"
                                class="btn btn-success btn-sm me-2" @click="openViewModal(department)">
                                <i class="fa fa-eye"></i> View
                            </button>
                            <button style="width:100px" class="btn btn-secondary btn-sm me-2 "
                                @click="openEditModal(department)">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button style="width:100px" class="btn btn-danger btn-sm "
                                @click="openDeleteModal(department)">
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

        <!-- View Modal -->
        <div data-bs-theme="dark" class="modal" tabindex="-1" v-if="viewModalOpen">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View Department</h5>
                        <button type="button" class="btn-close" @click="viewModalOpen = false"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> {{ selectedDepartment.name }}</p>
                        <p ><strong>Organisation:</strong> {{ selectedDepartment.organisation.name }}</p>
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
                        <h5 class="modal-title">Edit Department</h5>
                        <button type="button" class="btn-close" @click="editModalOpen = false"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" v-model="selectedDepartment.name" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="updateDepartment">Save Changes</button>
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
                        <h5 class="modal-title">Delete Department</h5>
                        <button type="button" class="btn-close" @click="deleteModalOpen = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Department?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteDepartment">Delete</button>
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
                organisation_id: ""
            },
            departments: [],
            selectedDepartment: {},
            showImportModal: false,
            showSuccessModal: false,
            showFailModal: false,
            showUpdateSuccessModal: false,
            showDeleteSuccessModal: false,
            viewModalOpen: false,
            editModalOpen: false,
            deleteModalOpen: false,
            currentPage: 1,
            departmentsPerPage: 20,
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.departments.length / this.departmentsPerPage);
        },
        paginatedDepartments() {
            const start = (this.currentPage - 1) * this.departmentsPerPage;
            return this.departments.slice(start, start + this.departmentsPerPage);
        },
    },
    methods: {
        async submitForm() {
            try {
                await axios.post("/api/department", this.form);
                this.showSuccessModal = true;
                this.form = { name: "",organisation_id: "" };
                this.fetchDepartments();

                //automatically hide the success modal after submittig the form
                setTimeout(() => {
                    this.showSuccessModal = false;
                }, 10000); // 10 seconds

            } catch (error) {
                this.showFailModal = true;
                this.form = { name: "" };
                console.error("Error submitting form:", error);

                //automatically hide the fail modal after submiting a form
                setTimeout(() => {
                    this.showFailModal = false;
                }, 10000); // 10 seconds

            }
        },

        //for fetching the data fron the database
        async fetchDepartments() {
            try {
                const response = await axios.get("/api/departments");
                this.departments = response.data;

            } catch (error) {
                console.error("Error fetching departments:", error);
            }
        },
        changePage(page) {
            if (page < 1 || page > this.totalPages) return;
            this.currentPage = page;
        },
        openViewModal(department) {
            this.selectedDepartment = { ...department };
            this.viewModalOpen = true;
        },
        openEditModal(department) {
            this.selectedDepartment = { ...department };
            this.editModalOpen = true;
        },
        async updateDepartment() {
            try {
                await axios.put(`/api/department/${this.selectedDepartment.id}`, this.selectedDepartment);
                this.showUpdateSuccessModal = true;
                this.editModalOpen = false;
                this.fetchDepartments();

                //automatically make the update modal disapper after updating
                setTimeout(() => {
                    this.showUpdateSuccessModal = false;
                }, 10000); // 10 seconds

            } catch (error) {
                console.error("Error updating department:", error);
            }
        },
        openDeleteModal(department) {
            this.selectedDepartment = { ...department };
            this.deleteModalOpen = true;
        },
        async deleteDepartment() {
            try {
                await axios.delete(`/api/department/${this.selectedDepartment.id}`);
                this.showDeleteSuccessModal = true;
                this.deleteModalOpen = false;
                this.fetchDepartments();
                //automatically make the delete success modal disapper
                setTimeout(() => {
                    this.showDeleteSuccessModal = false;
                }, 10000); // 10 seconds

            } catch (error) {
                console.error("Error deleting department:", error);
            }
        },
    },
    created() {
        this.fetchDepartments();
    },
};
</script>

<style scoped>
.modal {
    display: block;
    /* Ensure modals are displayed */
}
</style>