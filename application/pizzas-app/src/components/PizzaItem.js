import { GiPizzaSlice } from 'react-icons/gi';

function PizzaItem(props) {
  return (
    <div className='pizza-item__container' key={props.key}>
      <div className='pizza-item__icon'>
        <GiPizzaSlice />
      </div>
      <div className='pizza-item__description'>
        <p className='pizza-item__name'>{props.name}</p>
        <p className='pizza-item__price'>{props.price} €</p>
      </div>
    </div>
  );
}

export default PizzaItem;
