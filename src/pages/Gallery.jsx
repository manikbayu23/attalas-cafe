import SlidePageLayouts from '../components/Layouts/SlidePageLayouts'
import bgImage from "../assets/images/gallery-intro.jpeg"
import PageLayouts from '../components/Layouts/PageLayouts'
import RowGallery from '../components/Fragments/Gallery/RowGallery'
import Head from '../components/Layouts/Head'


const Gallery = () => {
    return (
        <>
            <Head title="Gallery Page" description="Nimati Sensai ngopi dengan pemandangan alam Gunung dan Danau Batur di Attalas Cafe" />
            <SlidePageLayouts image={bgImage} title="Gallery" secondtitle="Gallery" />
            <PageLayouts>
                <RowGallery />
            </PageLayouts>
        </>
    )
}
export default Gallery