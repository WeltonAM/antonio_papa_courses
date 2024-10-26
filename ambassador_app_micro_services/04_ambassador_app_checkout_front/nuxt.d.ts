import { NuxtAxiosInstance } from '@nuxtjs/axios';
import { Stripe } from 'stripe';

declare module '@nuxt/types' {
  interface Context {
    $axios: NuxtAxiosInstance;
    $stripe: Stripe;
  }

  interface NuxtAppOptions {
    $axios: NuxtAxiosInstance;
    $stripe: Stripe;
  }
}
