
import { createRouter, createWebHashHistory } from 'vue-router';
import FormComponent from '../components/FormComponent.vue';
import DashboardComponent from '../components/DashboardComponent.vue';
import OrganisationComponent from '../components/OrganisationComponent.vue';
import DepartmentComponent from '../components/DepartmentComponent.vue';
import GroupComponent from '../components/GroupComponent.vue';


const routes = [
  {
    path: '/',
    // You do not need to include NavbarComponent here
    component: DashboardComponent, // Or whatever main component you want to show
  },
  {
    //for the contacts
    path: '/contacts',
    component: FormComponent,
  },
  //for the organisations
  {
    path: '/organisations',
    component: OrganisationComponent,
  },
 //for the departments
 {
  path: '/departments',
  component: DepartmentComponent,
},
 //for the groups
 {
  path: '/groups',
  component: GroupComponent,
},

];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
