import Menu from './Menu';

function Main(props) {
  return (
    <div className='main-container'>
      <Menu />
      {props.children}
    </div>
  );
}
export default Main;
