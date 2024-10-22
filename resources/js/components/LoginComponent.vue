<template>

<div style="margin-top:px; margin-left:x; margin-bottom:px; margin-right:px;" class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 ">
            <h2 class="text-left">Login</h2>
            <form class="mx-auto">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" required>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input bg bg-success" id="exampleCheck1">
    <label class="form-check-label " for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-success">Login</button>
</form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>











    <div>
      <h1>Login</h1>
      <form @submit.prevent="login">
        <div>
          <label>Email:</label>
          <input type="email" v-model="email" />
        </div>
        <div>
          <label>Password:</label>
          <input type="password" v-model="password" />
        </div>
        <button type="submit">Login</button>
      </form>
      <p v-if="errorMessage">{{ errorMessage }}</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { ref } from 'vue';
  
  export default {
    setup() {
      const email = ref('');
      const password = ref('');
      const errorMessage = ref('');
  
      const login = async () => {
        try {
          const response = await axios.post('/api/login', {
            email: email.value,
            password: password.value,
          });
  
          if (response.data.message === 'Login successful') {
            // Redirect to dashboard or set authenticated state
            window.location.href = '/Dashboard'; // Redirect to dashboard
          }
        } catch (error) {
          errorMessage.value = 'Invalid credentials';
        }
      };
  
      return {
        email,
        password,
        errorMessage,
        login,
      };
    },
  };
  </script>
  