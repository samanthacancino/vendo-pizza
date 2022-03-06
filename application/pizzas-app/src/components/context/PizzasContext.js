import { createContext, useState } from 'react';

export const PizzasContext = createContext();

function PizzasContextProvides(props) {
  const [pizzas, setPizzas] = useState([
    {
      id: '',
      name: '',
      price: '',
    },
  ]);

  const [ingredients, setIngredients] = useState([
    {
      id: '',
      name: '',
      cost: '',
    },
  ]);

  const [isPending, setIsPending] = useState(false);

  return (
    <PizzasContext.Provider
      value={{
        pizzas,
        setPizzas,
        ingredients,
        setIngredients,
        isPending,
        setIsPending,
      }}
    >
      {props.children}
    </PizzasContext.Provider>
  );
}

export default PizzasContextProvides;
