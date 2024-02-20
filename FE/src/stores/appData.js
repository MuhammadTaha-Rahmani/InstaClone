import { defineStore } from "pinia";

export const useAppDataStore = defineStore("appData", {
  state: () => ({
    email: null,
    userDetail: null,
  }),

  getters: {},

  actions: {},
});
