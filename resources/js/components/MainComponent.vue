<template>
    <div>
      
      <NavbarComponent />
      
      <FormComponent />
      <!-- <columns/> -->
     
    </div>
  </template>
  
  <script>
   import columns from './columns.vue';
  import NavbarComponent from './NavbarComponent.vue';
  import FormComponent from './FormComponent.vue';
 
 
  // app.js or main.js
import 'bootstrap'; // Import Bootstrap JavaScript
import 'bootstrap/dist/css/bootstrap.min.css'; // Import Bootstrap CSS

  
  export default {
    name: 'MainComponent',
    components: {
      columns,
      NavbarComponent,
      FormComponent,
     
    },
  };
  </script>
  