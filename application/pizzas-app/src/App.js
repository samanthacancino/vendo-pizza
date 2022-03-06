import { Route, Switch } from 'react-router-dom';
import PizzasList from './components/pages/PizzasList';
import IngredientsList from './components/pages/IngredientsList';
import Welcome from './components/pages/Welcome';
import Main from './components/layout/Main';
import PizzasContextProvider from './components/context/PizzasContext';
import AddPizza from './components/AddPizza';
import AddIngredient from './components/AddIngredient';
import './assets/styles/main.scss';

function App() {
  return (
    <Main>
      <Switch>
        <Route path='/' exact>
          <Welcome />
        </Route>
        <PizzasContextProvider>
          <Route path='/pizzas' exact>
            <PizzasList />
          </Route>
          <Route path='/pizzas/form' exact>
            <AddPizza />
          </Route>
          <Route path='/ingredients' exact>
            <IngredientsList />
          </Route>
          <Route path='/ingredients/form' exact>
            <AddIngredient />
          </Route>
        </PizzasContextProvider>
      </Switch>
    </Main>
  );
}

export default App;
