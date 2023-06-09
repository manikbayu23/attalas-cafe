import ImagesGallery from "../../Elements/Images/ImagesGallery"
import gambar1 from "../../../assets/images/gambar-1.png"
import gambar2 from "../../../assets/images/gambar-2.png"
import gambar3 from "../../../assets/images/gambar-3.png"
import gambar4 from "../../../assets/images/gambar-4.png"

const RowGalley = () => {
    return (
        <div className="gallery-content">
            <ImagesGallery image={gambar1} alt="gambar 1" />
            <ImagesGallery image={gambar2} alt="gambar 2" />
            <ImagesGallery image={gambar3} alt="gambar 3" />
            <ImagesGallery image={gambar4} alt="gambar 4" />
            <ImagesGallery image={gambar1} alt="gambar 1" />
        </div>

    )
}

export default RowGalley