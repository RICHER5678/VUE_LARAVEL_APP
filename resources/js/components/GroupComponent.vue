<template>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="container mt-4">
        <h2 class="text-left">Group</h2>
        <form @submit.prevent="submitForm">
            <div class="row">
                <div class="col mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" v-model="form.name" required />
                </div>
                <div class=" col mb-3">
                    <label for="organisation_id" class="form-label">Department</label>
                    <select class="form-control" v-model="form.department_id" required>
                        <option value="" disabled>Select Department</option>
                        <option v-for="department in departments" :key="department.id" :value="department.id">
                            {{ department.name }}
                        </option>
                    </select>
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
                        <p>Group Created successfully!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showSuccessModal = false">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fail Modal for Form Submission -->
        <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showFailModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">Failure!</h5>
                        <button type="button" class="btn-close" @click="showFailModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Error Creating Group</p>
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
                        <p>Group updated successfully!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showUpdateSuccessModal = false">Close</button>
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
                        <p>Group deleted successfully!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showDeleteSuccessModal = false">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Groups -->
        <div class="container mb-4">
            <h3 class="mt-4">Groups</h3>
            <table data-bs-theme="" class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="group in paginatedGroups" :key="group.id">
                        <td>{{ group.id }}</td>
                        <td>{{ group.name }}</td>
                        <td>{{ group.department.name }}</td>
                        <td>
                            <button style="width:100px; margin-left:10px; margin-right: 0;"
                                class="btn btn-success btn-sm me-2" @click="openViewModal(group)">
                                <i class="fa fa-eye"></i> View
                            </button>
                            <button style="width:100px" class="btn btn-secondary btn-sm me-2" @click="openEditModal(group)">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button style="width:100px" class="btn btn-danger btn-sm" @click="openDeleteModal(group)">
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
                        <h5 class="modal-title">View Group</h5>
                        <button type="button" class="btn-close" @click="viewModalOpen = false"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> {{ selectedGroup.name }}</p>
                        <p ><strong>Organisation:</strong> {{ selectedGroup.department.name }}</p>
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
                        <h5 class="modal-title">Edit Group</h5>
                        <button type="button" class="btn-close" @click="editModalOpen = false"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" v-model="selectedGroup.name" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="updateGroup">Save Changes</button>
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
                        <h5 class="modal-title">Delete Group</h5>
                        <button type="button" class="btn-close" @click="deleteModalOpen = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Group?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteGroup">Delete</button>
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
            form: {
                name: "",
               
                department_id: ""
                
            },
            
            groups: [],
            departments: [],
            selectedGroup: {},
            selectedDepartment: {},
            showSuccessModal: false,
            showFailModal: false,
            showUpdateSuccessModal: false,
            showDeleteSuccessModal: false,
            viewModalOpen: false,
            editModalOpen: false,
            deleteModalOpen: false,
            currentPage: 1,
            groupsPerPage: 20,
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.groups.length / this.groupsPerPage);
        },
        paginatedGroups() {
            const start = (this.currentPage - 1) * this.groupsPerPage;
            return this.groups.slice(start, start + this.groupsPerPage);
        },
    },
    methods: {
        async submitForm() {
            try {
                await axios.post("/api/group", this.form);
                this.showSuccessModal = true;
                this.form = { name: "",  department_id: "" };
                this.fetchGroups();

                setTimeout(() => {
                    this.showSuccessModal = false;
                }, 10000); // 10 seconds

            } catch (error) {
                this.showFailModal = true;
                this.form = { name: "" };
                setTimeout(() => {
                    this.showFailModal = false;
                }, 10000); // 10 seconds
            }
        },

        async fetchDepartments() {
            try {
                const response = await axios.get("/api/departments");
                this.departments = response.data;
            } catch (error) {
                console.error("Error fetching departments:", error);
            }
        },
        async fetchGroups() {
            try {
                const response = await axios.get("/api/groups");
                this.groups= response.data;
            } catch (error) {
                console.error("Error fetching groups:", error);
            }
        },
 

        changePage(page) {
            if (page < 1 || page > this.totalPages) return;
            this.currentPage = page;
        },

        openViewModal(group) {
            this.selectedGroup = { ...group };
            this.viewModalOpen = true;
        },

        openEditModal(group) {
            this.selectedGroup = { ...group };
            this.editModalOpen = true;
        },

        async updateGroup() {
            try {
                await axios.put(`/api/group/${this.selectedGroup.id}`, this.selectedGroup);
                this.showUpdateSuccessModal = true;
                this.editModalOpen = false;
                this.fetchGroups();

                setTimeout(() => {
                    this.showUpdateSuccessModal = false;
                }, 10000); // 10 seconds

            } catch (error) {
                console.error("Error updating group:", error);
            }
        },

        openDeleteModal(group) {
            this.selectedGroup = { ...group };
            this.deleteModalOpen = true;
        },

        async deleteGroup() {
            try {
                await axios.delete(`/api/group/${this.selectedGroup.id}`);
                this.showDeleteSuccessModal = true;
                this.deleteModalOpen = false;
                this.fetchGroups();

                setTimeout(() => {
                    this.showDeleteSuccessModal = false;
                }, 10000); // 10 seconds

            } catch (error) {
                console.error("Error deleting group:", error);
            }
        },
    },
    mounted() {
        this.fetchDepartments();
        this.fetchGroups();
    },
};
</script>


<style scoped>
.modal {
    display: block;
    /* Ensure modals are displayed */
}
</style>