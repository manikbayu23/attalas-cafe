import { Parallax } from 'react-parallax';
import gambarBar from '../../../assets/images/foto-kopi.jpeg';
const SlideHome = () => {
    const handleClick = (e) => {
        e.preventDefault();
        const targetElement = document.querySelector('#intro-home');
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    };

    return (
        <Parallax bgImage={gambarBar} bgImageAlt="bar cafe" strength={-100}>
            <div className="slide-home" >
                <div className="container">
                    <h1 className="title-1" data-aos="fade-up" data-aos-delay="100">Attalas Cafe</h1>
                    <h2 className="title-2" data-aos="fade-up" data-aos-delay="200">COFFE AND DRINK</h2>
                    <p className="p-slide-home" data-aos="fade-up" data-aos-delay="300">Selamat datang di Attalas Cafe! Nikmati suasana yang hangat dan nyaman <br />
                        sambil menikmati segelas kopi yang segar dan berkualitas.</p>
                    <a href='#intro-home' className="link-learnmore" onClick={handleClick} data-aos="fade-in" data-aos-delay="500"> LEARN MORE</a>
                </div>
            </div>
        </Parallax>
    );
}
export default SlideHome;

