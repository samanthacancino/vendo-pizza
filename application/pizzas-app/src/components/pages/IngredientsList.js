import { Fragment, useEffect, useContext } from 'react';
import { Link } from 'react-router-dom';
import { PizzasContext } from '../context/PizzasContext';
import ingredientImage from '../../assets/images/ingredients.jpg';
import IngredientItem from '../IngredientItem';

function IngredientsList() {
  const { ingredients, setIngredients, isPending, setIsPending } =
    useContext(PizzasContext);

  useEffect(() => {
    setIsPending(true);
    fetch(
      'https://vendopizza-4267e-default-rtdb.europe-west1.firebasedatabase.app/ingredients.json'
    )
      .then((response) => {
        return response.json();
      })
      .then((data) => {

        const transformIngredients = [];
        for (const key in data) {
          const ingredientObj = {
            id: key,
            ...data[key],
          };

          transformIngredients.push(ingredientObj);
        }
        for (let i in transformIngredients) {
          transformIngredients[i].id = i;
        }
        setIngredients(transformIngredients);
      });
    setIsPending(false);
  }, [setIsPending, isPending]);

  return (
    <Fragment>
      <div className='form__add'>
        <Link to={'/ingredients/form'} onClick={() => setIsPending(true)}>
          <p>ADD INGREDIENT</p>
        </Link>
      </div>
      <div className='ingredient-list__container'>
        <img
          className='ingredient-list__image'
          src={ingredientImage}
          alt='ingredient'
        />
        <div className='ingredient-list'>
          <h1 className='ingredient-list__title'>Ingredients </h1>
          {!isPending && ingredients.length > 0 ? (
            <div className='ingredient-list__items'>
              <ul>
                {ingredients.map((ingredient, key) => (
                  <IngredientItem
                    keyItem={key}
                    name={ingredient.name}
                    cost={ingredient.cost}
                    id={ingredient.id}
                  />
                ))}
              </ul>
            </div>
          ) : (
            <ul>
              <li>Patata</li>
            </ul>
          )}
        </div>
      </div>
    </Fragment>
  );
}

export default IngredientsList;
