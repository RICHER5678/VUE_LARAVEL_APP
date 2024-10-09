
import { createRouter, createWebHashHistory } from 'vue-router';
import FormComponent from '../components/FormComponent.vue';
import DashboardComponent from '../components/DashboardComponent.vue';
import OrganisationComponent from '../components/OrganisationComponent.vue';


const routes = [
  {
    path: '/',
    // You do not need to include NavbarComponent here
    component: DashboardComponent, // Or whatever main component you want to show
  },
  {
    //for the contacts
    path: '/form',
    component: FormComponent,
  },
  //for the organisations
  {
    path: '/organisation',
    component: OrganisationComponent,
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
