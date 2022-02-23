import { useEffect, useState } from 'react';


function PizzasList() {
    const [pizzas, setPizzas] = useState([]);
    
    
    useEffect(() => {
      const ENDPOINT = '/rest-pizza';
      fetch(ENDPOINT)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            setPizzas(data)}
            );

  }, [setPizzas]);


  return (
    <div className='pizzas-list'>
      <ul>
          {pizzas.map((pizza) => (
              <li key={pizza.id}>{pizza.name}</li>
          ))}
      </ul>
    </div>
  );
}

export default PizzasList;
