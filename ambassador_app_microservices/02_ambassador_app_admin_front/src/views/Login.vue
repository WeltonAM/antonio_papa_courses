<template>
  <div class="d-flex flex-column align-items-center vh-100">
    <main class="form-signin">
      <form @submit.prevent="submit" class="d-flex flex-column justify-center gap-4">
        <h1 class="fw-normal text-center">Sing in</h1>
        
        <div class="form-floating">
          <input v-model="email" type="email" class="form-control" placeholder="name@example.com">
          <label>Email address</label>
        </div>
        
        <div class="form-floating">
          <input v-model="password" type="password" class="form-control" placeholder="Password">
          <label>Password</label>
        </div>
        
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <a href="/register" class="text-center">Sing up</a>
      </form>
    </main>
  </div>
</template>

<script>
import axios from "axios";
import { defineComponent } from "vue";

export default defineComponent({
  name: "Login",
  data() {
    return {
      email: '',
      password: '',
    }
  },
  methods: {
    async submit() {
      try {
        const response = await axios.post('login', {
          email: this.email,
          password: this.password
        });

        const token = response.data.token; 
        localStorage.setItem('token', token); 

        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        
        console.log('Login bem-sucedido:', response.data);
        await this.$router.push('/');
      } catch (error) {
        console.error('Erro de autenticação:', error.response.data);
        alert('Erro de autenticação: ' + (error.response.data.error || 'Erro desconhecido'));
      }
    }
  },
})
</script>

<style scoped>
.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
