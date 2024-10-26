<template>
  <main class="form-signin">
    <form @submit.prevent="submit">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating">
        <input v-model="email" type="email" class="form-control" placeholder="name@example.com" required>
        <label>Email address</label>
      </div>

      <div class="form-floating">
        <input v-model="password" type="password" class="form-control" placeholder="Password" required>
        <label>Password</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
  </main>
</template>

<script>
import axios from "axios";
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { onMounted, ref } from 'vue';

export default {
  name: "Login",
  setup() {
    const store = useStore();
    const router = useRouter();
    const email = ref('');
    const password = ref('');

    onMounted(async () => { 
      if(localStorage.getItem('token')) {
        await router.push('/');
      }
    });

    const submit = async () => {
      try {
        const response = await axios.post('login', {
          email: email.value,
          password: password.value
        });
        
        const token = response.data.token;
        
        localStorage.setItem('token', token);
        
        await store.dispatch('setUser', token);
        
        await router.push('/');
      } catch (error) {
        console.error("Erro ao fazer login:", error);
      }
    };

    return { email, password, submit };
  }
};
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
