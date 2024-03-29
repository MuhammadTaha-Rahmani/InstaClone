const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/IndexPage.vue"),
        meta: {
          requireauth: true,
        },
      },
    ],
  },
  {
    path: "/posts",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/PostsPage.vue"),
        meta: {
          requireauth: true,
        },
      },
    ],
  },
  {
    path: "/posts/:id",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/ShowPost.vue"),
        meta: {
          requireauth: true,
        },
      },
    ],
  },
  {
    path: "/addPost",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/AddPost.vue"),
        meta: {
          requireauth: true,
        },
      },
    ],
  },
  {
    path: "/register",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/Auth/RegisterPage.vue"),
        meta: {
          authentication: true,
        },
      },
    ],
  },
  {
    path: "/login",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/Auth/LoginPage.vue"),
        meta: {
          authentication: true,
        },
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
