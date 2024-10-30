<template>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="container mt-4">
        <p style="margin-top:50px;">Create>Message</p>
        <h2 class="text-left">Send a Message</h2>
        <!-- form for departments -->
        <form @submit.prevent="submitForm">
            <div class="row">
                <div class="col mb-3">
                    <label for="name" class="form-label">Sender ID</label>
                    <input type="text" class="form-control" id="sender_id" v-model="form.sender_id" required />
                </div>
                <div class=" col mb-3">
                    <label for="department_id" class="form-label">Department</label>
                    <!-- <input type="number" class="form-control" id="department_id" v-model="form.department_id" required /> -->
                    <select class="form-control" v-model="form.department_id" required>
                        <option value="" disabled>Select a Department</option>
                        <option v-for="department in departments" :key="department.id" :value="department.id">
                            {{ department.name }}
                        </option>
                    </select>
                </div>
                <div class=" col mb-3">
                    <label for="group_id" class="form-label">Group</label>
                    <select class="form-control" v-model="form.group_id" required>
                        <option value="" disabled>Select a Group</option>
                        <option v-for="group in groups" :key="group.id" :value="group.id">
                            {{ group.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-floating">
                        <textarea style="height:200px;" class="form-control" placeholder="Leave a comment here"
                            id="message_content" v-model="form.message_content"></textarea>
                        <label for="message_content">Enter your message here!</label>
                    </div>
                </div>
            </div>

<!-- for scheduling -->
       <!-- Toggle Switch -->
       <div class="form-check form-switch mb-4">
            <input style="width:35px; height:20px;"
                class="form-check-input"
                type="checkbox"
                id="scheduleToggle"
                v-model="isScheduled"
                @change="toggleScheduleModal"
              
            />
            <label class="form-check-label" for="scheduleToggle">Schedule a Date & Time</label>
        </div>

        <!-- Schedule Modal -->
        <div
            class="modal fade"
            tabindex="-1"
            ref="scheduleModal"
            :class="{ show: showScheduleModal }"
            :style="{ display: showScheduleModal ? 'block' : 'none' }"
            role="dialog"
            aria-labelledby="scheduleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scheduleModalLabel">Set a Schedule</h5>
                        <button type="button" class="btn-close" aria-label="Close" @click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="datetime" class="form-label">Choose Date & Time:</label>
                        <input
                            type="datetime-local"
                            id="datetime"
                            v-model="selectedDateTime"
                            class="form-control"
                            
                        />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">Cancel</button>
                        <button type="button" class="btn btn-primary" @click="saveSchedule">Save Schedule</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Backdrop for Modal -->
        <div class="modal-backdrop fade" :class="{ show: showScheduleModal }" v-if="showScheduleModal"></div>
 <!-- for sheduling -->





            <button type="submit" class="btn btn-success">Send&nbsp;<i class="fa fa-check"></i></button>
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
                        <p>Message sent successfully!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showSuccessModal = false">Close</button>
                    </div>
                </div>
            </div>
        </div>

             <!-- date time select Modal for Form Submission -->
             <div   class="modal align-items-left text-light" tabindex="-1" v-if="selectDateTimeModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Date and Time not selected!!!!</h5>
                        <button type="button" class="btn-close" @click="selectDateTimeModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <p>Please select date and time.&#128531;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="selectDateTimeModal = false">Close</button>
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
                        <p>Error sending message!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showFailModal = false">Close</button>
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
                sender_id: "",
                department_id: "",
                group_id: "",
                message_content: ""
            },
            groups: [], // Organisations data for the dropdown inside the form
            departments: [],
            selectedDepartment: {},
            showSuccessModal: false,
            selectDateTimeModal: false,
            showFailModal: false,
            isScheduled: false,        // Tracks the toggle switch state
            showScheduleModal: false,  // Tracks modal visibility
            selectedDateTime: ''       // Stores selected date-time

        };
    },

    methods: {
        //for handling the form submission
        async submitForm() {
            try {
                await axios.post("/api/message", this.form);
                this.showSuccessModal = true;
                this.form = { sender_id: "", department_id: "", group_id: "", message_content: "" };

                setTimeout(() => {
                    this.showSuccessModal = false;
                }, 10000); // 10 seconds

            } catch (error) {
                this.showFailModal = true;
                this.form = { sender_id: "", department_id: "", group_id: "", messsage_content: "" };
                setTimeout(() => {
                    this.showFailModal = false;
                }, 10000); // 10 seconds
            }
        },
        //for fetching the departments from the database to populate the drop down 
        async fetchDepartments() {
            try {
                const response = await axios.get("/api/departments");
                this.departments = response.data;
            } catch (error) {
                console.error("Error fetching departments:", error);
            }
        },

        //for fetching the GROUPS to populate the drop down
        async fetchGroups() {
            try {
                const response = await axios.get("/api/groups");
                this.groups = response.data;
            } catch (error) {
                console.error("Error fetching groups:", error);
            }
        },


        //for sheduling
        toggleScheduleModal() {
            // Open the modal if toggle is on; close otherwise
            if (this.isScheduled) {
                this.showScheduleModal = true;
                document.body.classList.add("modal-open"); // Prevents scrolling behind modal
            } else {
                this.closeModal();
            }
        },
        closeModal() {
            this.showScheduleModal = false;
            this.isScheduled = false; // Reset toggle when closing modal
            document.body.classList.remove("modal-open");
        },
        saveSchedule() {
         
            if(this.selectedDateTime == ''){
                this.selectDateTimeModal = true;
                // alert('please select time and date!!!')
            }else{
   // Handle saving the schedule (e.g., send to server, display confirmation)
   console.log("Scheduled Date & Time:", this.selectedDateTime);
            this.closeModal();
            } 
        },
      
        //for sheduling 

    },
    //POPuLATE THE SELECT DROP DOWN
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

/* Style modal as per Bootstrap standards */
.modal.fade {
    display: none;
}
.modal-backdrop.fade.show {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1040;
}
.modal-open .modal {
    overflow-y: auto;
}
</style>
