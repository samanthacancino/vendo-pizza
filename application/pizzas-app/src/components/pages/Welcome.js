import welcomeImage from '../../assets/images/welcome.jpg';

function Welcome() {
  return (
    <div className='welcome__container'>
      <img className='welcome__image' src={welcomeImage} alt='Welcome pizza' />
      <div className='welcome__text'>
        <h1>WELCOME</h1>
        <p>You can add as many pizzas and ingredients as you want!</p>
      </div>
    </div>
  );
}

export default Welcome;
