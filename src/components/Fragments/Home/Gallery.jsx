
import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";

import gambar1 from "../../../assets/images/gambar-1.png"
import gambar2 from "../../../assets/images/gambar-2.png"
import gambar3 from "../../../assets/images/gambar-3.png"
import gambar4 from "../../../assets/images/gambar-4.png"

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faMagnifyingGlassPlus } from '@fortawesome/free-solid-svg-icons';

const Gallery = () => {
  const settings = {
    dots: true,
    infinite: false,
    speed: 500,
    slidesToShow: 4,
    slidesToScroll: 4,
    arrows: false,
    initialSlide: 0,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          initialSlide: 2
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  };
  return (
    <div className="gallery-home">
      <h1 className="title-1" data-aos="fade-up">Gallery</h1>
      <Slider  {...settings}>
        <div className='gambar-slide' style={{ margin: '10px' }} data-aos="fade-up" data-aos-delay="100">
          <div className="slider-gallery">
            <img src={gambar1} alt='gambar 1' />
            <FontAwesomeIcon className="icon-plus" icon={faMagnifyingGlassPlus} />
          </div>
        </div>
        <div className='gambar-slide' data-aos="fade-up" data-aos-delay="200">
          <div className="slider-gallery">
            <img src={gambar2} alt='gambar 2' />
            <FontAwesomeIcon className="icon-plus" icon={faMagnifyingGlassPlus} />
          </div>
        </div>
        <div className='gambar-slide' data-aos="fade-up" data-aos-delay="300">
          <div className="slider-gallery">
            <img src={gambar3} alt='gambar 3' />
            <FontAwesomeIcon className="icon-plus" icon={faMagnifyingGlassPlus} />
          </div>
        </div>
        <div className='gambar-slide' data-aos="fade-up" data-aos-delay="400">
          <div className="slider-gallery">
            <img src={gambar4} alt='gambar 4' />
            <FontAwesomeIcon className="icon-plus" icon={faMagnifyingGlassPlus} />
          </div>
        </div>
        <div className='gambar-slide' data-aos="fade-up" data-aos-delay="500">
          <div className="slider-gallery">
            <img src='' alt='gambar 5' />
            <FontAwesomeIcon className="icon-plus" icon={faMagnifyingGlassPlus} />
          </div>
        </div>
      </Slider>
    </div>
  );
};

export default Gallery;