<template>
  <div>
    <navbar-component /> <!-- Render navbar here -->
    <router-view /> <!-- Render routed components here -->
  </div>
</template>

<script>
// Import the NavbarComponent here
import NavbarComponent from './NavbarComponent.vue'; 

export default {
  name: "MainComponent",
  components: {
    NavbarComponent // Register the navbar component locally
  },
};
</script>

<style>
/* Add any global styles you may need */
</style>
