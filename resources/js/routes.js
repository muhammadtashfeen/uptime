import NotFound from './components/NotFound';

export default {
  mode: 'history',
  linkActiveClass: 'font-bold',
  routes: [
      {
          path: '*',
          component: NotFound
      }
  ]
};