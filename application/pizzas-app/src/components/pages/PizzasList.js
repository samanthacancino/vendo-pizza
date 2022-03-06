import { Fragment, useEffect, useContext } from 'react';
import { Link } from 'react-router-dom';
import { PizzasContext } from '../context/PizzasContext';
import PizzaItem from '../PizzaItem';

function PizzasList() {
  const { pizzas, setPizzas, isPending, setIsPending } =
    useContext(PizzasContext);

  useEffect(() => {
    setIsPending(true);
    fetch(
      'https://vendopizza-4267e-default-rtdb.europe-west1.firebasedatabase.app/pizzas.json'
    )
      .then((response) => {
        return response.json();
      })
      .then((data) => {

        const transformPizzas = [];
        for (const key in data) {
          const pizzaObj = {
            id: key,
            ...data[key],
          };

          transformPizzas.push(pizzaObj);
        }
         for (let i in transformPizzas) {
           transformPizzas[i].id = i;
         }
        setPizzas(transformPizzas);
      });
    setIsPending(false);
  }, [setIsPending, isPending]);

  return (
    <Fragment>
      <div className='form__add'>
        <Link to={'/pizzas/form'} onClick={() => setIsPending(true)}>
          <p>ADD PIZZA</p>
        </Link>
      </div>
      <h1 className='pizza-list__title'>Pizzas</h1>
      {!isPending && pizzas.length > 0 ? (
        <div className='pizza-list'>
          {pizzas.map((pizza, key) => (
            <PizzaItem key={key} name={pizza.name} price={pizza.price} />
          ))}
        </div>
      ) : (
        <ul>
          <li>Patata</li>
        </ul>
      )}
    </Fragment>
  );
}

export default PizzasList;
