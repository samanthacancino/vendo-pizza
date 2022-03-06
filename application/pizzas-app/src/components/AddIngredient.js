import { useState, useContext, useEffect } from 'react';
import { PizzasContext } from './context/PizzasContext';
import { useHistory } from 'react-router-dom';

function AddIngredient() {
  const ENDPOINT =
    'https://vendopizza-4267e-default-rtdb.europe-west1.firebasedatabase.app/ingredients.json';

  const { ingredients, setIngredients, isPending, setIsPending } =
    useContext(PizzasContext);
  const [addedIngredient, setAddedIngredient] = useState(false);

  let history = useHistory();

  useEffect(() => {
    if (addedIngredient) {
      setIsPending(true);
      history.push('/ingredients');
    }
  }, [addedIngredient, history]);

  function handleSubmit(e) {
    e.preventDefault();
    setAddedIngredient(false);
    const insertData = {
      id: '',
      name: ingredients.name,
      cost: ingredients.cost,
    };
    fetch(ENDPOINT, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(insertData),
    })
      .then(() => setIngredients(insertData));
    setAddedIngredient(true);
  }

  function handleInput(e) {
    const newData = { ...ingredients };
    newData[e.target.id] = e.target.value;
    setIngredients(newData);
  }

  return (
    <div>
      <form onSubmit={(e) => handleSubmit(e)}>
        <input
          className='form__input'
          onChange={(e) => handleInput(e)}
          id='name'
          value={ingredients.name || ''}
          type='text'
          name='name'
          placeholder='name'
        />
        <input
          className='form__input'
          onChange={(e) => handleInput(e)}
          id='cost'
          value={ingredients.cost || ''}
          type='number'
          name='cost'
          placeholder='cost'
        />
        <button className='form__button'>Add</button>
      </form>
    </div>
  );
}

export default AddIngredient;
