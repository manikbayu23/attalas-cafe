import { Parallax } from 'react-parallax';

const SlidePageLayouts = (props) => {

    const { title, image, secondtitle } = props;

    return (
        <Parallax bgImage={image} >
            <div className="slide-page">
                <div className="container">
                    <h1 className="title-2" data-aos="fade-up" data-aos-delay="100">{title}</h1>
                    <div className="nav-page" data-aos="fade-up" data-aos-delay="200" >Home - <span>{secondtitle}</span> </div>
                </div>
            </div>
        </Parallax>
    )
}

export default SlidePageLayouts;