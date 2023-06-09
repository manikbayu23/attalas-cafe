import gambar from '../../../assets/images/image-intro.png'

const IntroHome = () => {

    return (

        <div className="intro-home" id='intro-home'>
            <div className="container">
                <div className="row-intro">
                    <div className="col-intro col-a">
                        <div className="card-intro" data-aos="fade-up">
                            <h1 className="title-1" data-aos="fade-up" data-aos-delay="100">
                                Welcome To Attalas  Cafe</h1>
                            <p data-aos="fade-up">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud ullamco nisi laboris ut aliquip ex ea commodo consequat. Duis aute irure dolor.
                            </p>
                        </div>
                    </div>
                    <div className="col-intro" data-aos="fade-up">
                        <img src={gambar} alt='gambar-intro' className='gambar-intro' />
                    </div>
                </div>
            </div>
        </div>

    );

}
export default IntroHome