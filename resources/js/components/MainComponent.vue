<template>
    <div>
      <NavbarComponent />
      <FormComponent />
      <!-- <columns/> -->
    </div>
  </template>
  
  <script scoped>
  import columns from './columns.vue';
  import NavbarComponent from './NavbarComponent.vue';
  import FormComponent from './FormComponent.vue';

  
  export default {
    name: 'MainComponent',
    components: {
      columns,
      NavbarComponent,
      FormComponent,
     
    },
  };
  </script>