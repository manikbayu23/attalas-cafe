import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';


const CardContact = (props) => {
    return (
        <div className="card-contact">
            <div><span><FontAwesomeIcon icon={props.icon} /></span> {props.text}</div>
        </div>
    )

}

export default CardContact;