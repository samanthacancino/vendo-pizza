import { useState, useContext, useEffect } from 'react';
import { PizzasContext } from './context/PizzasContext';
import { useHistory } from 'react-router-dom';

function AddPizza() {
  const ENDPOINT =
    'https://vendopizza-4267e-default-rtdb.europe-west1.firebasedatabase.app/pizzas.json';

  const { pizzas, setPizzas, isPending, setIsPending } =
    useContext(PizzasContext);
  const [dynamicId, setDynamicId] = useState(1);
  const [addedPizza, setAddedPizza] = useState(false);

  let history = useHistory();
  // const [pizzas, setPizzas] = useState({
  //   id: '',
  //   name: '',
  //   price: '',
  // });
  useEffect(() => {
    if (addedPizza) {
      setIsPending(true);
      history.push('/pizzas');
    }
  }, [addedPizza, history]);

  function handleSubmit(e) {
    e.preventDefault();
    setAddedPizza(false);
    setDynamicId((prevState) => prevState + 1);
    const insertData = {
      id: dynamicId,
      name: pizzas.name,
      price: pizzas.price,
    };
    fetch(ENDPOINT, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(insertData),
    })
      .then(() => setPizzas(insertData));

    setAddedPizza(true);
  }

  function handleInput(e) {
    const newData = { ...pizzas };
    newData[e.target.id] = e.target.value;
    setPizzas(newData);
  }

  return (
    <div>
      <form onSubmit={(e) => handleSubmit(e)}>
        <input
          className='form__input'
          onChange={(e) => handleInput(e)}
          id='name'
          value={pizzas.name || ''}
          type='text'
          name='name'
          placeholder='name'
        />
        <input
          className='form__input'
          onChange={(e) => handleInput(e)}
          id='price'
          value={pizzas.price || ''}
          type='number'
          name='price'
          placeholder='price'
        />
        <button className='form__button'>Add</button>
      </form>
    </div>
  );
}

export default AddPizza;
