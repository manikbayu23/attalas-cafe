import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

const ButtonMenu = (props) => {

    const { onclick, icon, change, nama } = props;
    return (
        <>
            <button onClick={onclick} className={`button-menu ${change}`}><span><FontAwesomeIcon icon={icon} /><div>{nama}</div></span> </button >
        </>
    );
}
export default ButtonMenu

