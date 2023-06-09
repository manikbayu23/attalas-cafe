import SlideHome from '../components/Fragments/Home/SlideHome'
import IntroHome from '../components/Fragments/Home/IntroHome';
import MenuHome from '../components/Fragments/Home/MenuHome';
import Gallery from '../components/Fragments/Home/Gallery';
import kopi from '../assets/images/kopi-1.png'
import kopi2 from '../assets/images/kopi-6.png'
import Head from '../components/Layouts/Head'

const Home = () => {
    return (
        <div>
            <Head title="Home Page" description="Nimati Sensai ngopi dengan pemandangan alam Gunung dan Danau Batur di Attalas Cafe" />
            <SlideHome />
            <IntroHome />
            <div data-aos="fade-right" data-aos-delay="100">
                <img src={kopi} alt='gambar-kopi' className='gambar-kopi1' />
            </div>
            <MenuHome />
            <div data-aos="fade-in" data-aos-delay="200">
                <img src={kopi2} alt='gambar-kopi' className='gambar-kopi2' />
            </div>
            <Gallery />
        </div>
    )
}
export default Home;
