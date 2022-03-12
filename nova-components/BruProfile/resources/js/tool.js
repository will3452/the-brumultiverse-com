import Tool from './components/Tool.vue';
Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'bru-profile',
      path: '/bru-profile',
      component: Tool,
    },
  ])
})
