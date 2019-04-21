import NotFound from './components/NotFound';
import Home from './components/Home';


export default {
  mode: 'history',
  linkActiveClass: 'font-bold',
  routes: [
      {
          path: '*',
          component: NotFound
      },
      {
          path: '/',
          component: Home
      }
  ]
};