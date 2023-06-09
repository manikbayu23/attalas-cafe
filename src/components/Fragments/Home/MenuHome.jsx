import kopi2 from '../../../assets/images/kopi-2.png'
import kopi3 from '../../../assets/images/kopi-3.png'
import kopi4 from '../../../assets/images/kopi-4.png'
const MenuHome = () => {
    return (
        <div className="menu-home">
            <div className="container">
                <div className="row-menu">
                    <div className="col-menu">
                        <div className="card-menu">
                            <div className="title-menu">
                                <h2 data-aos="fade-up" data-aos-delay="100" >Our Top Hits</h2>
                                <p data-aos="fade-in" data-aos-delay="200">Part of the secret of success in life is to eat what you like and let the food fight it out inside.
                                    Part of the secret of success in life is to eat what you like and let the food fight it out inside.</p>
                                <a data-aos="fade-up" data-aos-delay="300" href="/" className="link-readmore" >Read More</a>
                            </div>
                        </div>
                    </div>
                    <div className="col-menu" data-aos="fade-up" data-aos-delay="200">
                        <div className="card-menu">
                            <div className='overlay-card'></div>
                            <img src={kopi2} alt="kopi2" />
                            <span>Latte</span>
                            <div className="card-harga">50K</div>
                        </div>
                    </div>
                    <div className="col-menu" data-aos="fade-up" data-aos-delay="300">
                        <div className="card-menu">
                            <div className='overlay-card'></div>
                            <img src={kopi3} alt="kopi3" />
                            <span>Macachiato</span>
                            <div className="card-harga">50K</div>
                        </div>
                    </div>
                    <div className="col-menu" data-aos="fade-up" data-aos-delay="400">
                        <div className="card-menu">
                            <div className='overlay-card'></div>
                            <img src={kopi4} alt="kopi4" />
                            <span>Cappucino</span>
                            <div className="card-harga">50K</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default MenuHome;