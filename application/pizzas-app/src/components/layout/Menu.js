import { Link } from 'react-router-dom';
import { GiFullPizza } from 'react-icons/gi';

function Menu() {
  return (
    <nav className='menu'>
      <div className='logo'>
        <Link to='/'>
          <GiFullPizza />
        </Link>
      </div>
      <Link to='/ingredients'>
        <p> INGREDIENTS</p>
      </Link>
      <Link to='/pizzas'>
        <p>PIZZAS</p>
      </Link>
    </nav>
  );
}

export default Menu;
