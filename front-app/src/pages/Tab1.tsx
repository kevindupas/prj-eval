import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/react';
import ExploreContainer from '../components/ExploreContainer';
import './Tab1.css';
import useSWR from 'swr';
import { Key } from 'react';

const fetcher = (...args) => fetch(...args).then((res) => res.json());

const Tab1: React.FC = () => {

  const {
    data: products,
    error,
    isValidating,
  } = useSWR('http://127.0.0.1:8000/api/products', fetcher);

  // Handles error and loading state
  if (error) return <div className='failed'>failed to load</div>;
  if (isValidating) return <div className="Loading">Loading...</div>;


  return (
    <IonPage>
      <IonHeader>
        <IonToolbar>
          <IonTitle>Tab 1</IonTitle>
        </IonToolbar>
      </IonHeader>
      <IonContent fullscreen>
        <IonHeader collapse="condense">
          <IonToolbar>
            <IonTitle size="large">

            </IonTitle>
          </IonToolbar>
        </IonHeader>
        <div>
          {products &&
            products.map((item: { image: string | undefined; name: string }, index: Key | null | undefined) => (
              <div>
                <h1>{item.name}</h1>
                <img key={index} src={item.image} alt='image' width={100} />
              </div>
            ))}
        </div>
      </IonContent>
    </IonPage>
  );
};

export default Tab1;
