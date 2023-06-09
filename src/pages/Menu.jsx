import SlidePageLayouts from '../components/Layouts/SlidePageLayouts';
import PageLayouts from '../components/Layouts/PageLayouts';
import NavMenu from '../components/Fragments/Menu/NavMenu';
import RowMenu from '../components/Fragments/Menu/RowMenu';
import bgImage from '../assets/images/menu-page.png';
import Head from '../components/Layouts/Head';

const Menu = () => {
    return (
        <>
            <Head title="Menu Page" description="Nimati Sensai ngopi dengan pemandangan alam Gunung dan Danau Batur di Attalas Cafe" />
            <SlidePageLayouts title="Menu" secondtitle="Menu" image={bgImage} />
            <PageLayouts>
                <NavMenu />
                <RowMenu />
            </PageLayouts>
        </>
    )
}
export default Menu