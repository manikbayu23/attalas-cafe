
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faFacebook } from '@fortawesome/free-brands-svg-icons';
import { faInstagram } from '@fortawesome/free-brands-svg-icons';
import { faPhone } from '@fortawesome/free-solid-svg-icons';
import { faLocationDot } from '@fortawesome/free-solid-svg-icons';
import { faEnvelope } from '@fortawesome/free-solid-svg-icons';


const IntroHome = () => {

    return (
        <div className="footer">
            <div className="container">
                <div className="row-footer">
                    <div className="col-footer">
                        <h2 data-aos="fade-up">Logo</h2>
                        <p data-aos="fade-up">Lorem ipsum dolor sit amet, elit. Aenean ligula eget dolor. Lorem ipsum dolor sit amet, consectetur to adipisicing elit.
                            Lorem ipsum dolor sit amet, elit. Aenean ligula eget dolor. Lorem ipsum dolor sit amet, consectetur to adipisicing elit.
                        </p>
                        <div className='logo-sosmed'>
                            <a href='' className='icon-sosmed' data-aos="fade-up">
                                <FontAwesomeIcon size="lg" icon={faFacebook} />
                            </a>
                            <a href='' className='icon-sosmed' data-aos="fade-up">
                                <FontAwesomeIcon size="lg" icon={faInstagram} />
                            </a>
                        </div>
                    </div>
                    <div className="col-footer">
                        <h2 data-aos="fade-up">Contact Us</h2>
                        <div className='contact-icon' data-aos="fade-up">
                            <FontAwesomeIcon icon={faPhone} /> 0000000000
                        </div>
                        <div className='contact-icon' data-aos="fade-up">
                            <FontAwesomeIcon icon={faLocationDot} /> Jl. Raya Penelokan, Batur, Kintamni, Bangli.
                        </div>
                        <div className='contact-icon' data-aos="fade-up">
                            <FontAwesomeIcon icon={faEnvelope} /> attalascafe@gmail.com
                        </div>
                    </div>
                </div>
                <div className='label-footer'>
                    © Copyright by <span>Attalas Cafe 2023</span>
                </div>
            </div>
        </div>
    );
}
export default IntroHome