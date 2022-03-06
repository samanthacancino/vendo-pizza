function IngredientItem(props) {
  return (
    <li className='ingredient-item' key={props.keyItem}>
      {props.name} - {props.cost} €
    </li>
  );
}

export default IngredientItem;
