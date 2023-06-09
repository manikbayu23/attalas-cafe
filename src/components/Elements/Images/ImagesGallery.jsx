

const ImagesGallery = (props) => {
    const { index } = props;
    const delay = index * 100;
    return (
        <div className="col-gallery" data-aos="fade-up"
            data-aos-delay={delay}>
            <img src={props.image} className="gambar-gallery" alt={props.alt} />
        </div>
    )
}

export default ImagesGallery