import { Link } from 'react-router-dom';
import { ArrowRightIcon, MapPinIcon, BellAlertIcon, HandRaisedIcon } from '@heroicons/react/24/outline';

const features = [
  {
    name: 'Localisation précise',
    description: 'Indiquez précisément où vous avez perdu ou trouvé un objet pour faciliter les recherches.',
    icon: MapPinIcon,
  },
  {
    name: 'Notifications instantanées',
    description: 'Recevez des alertes en temps réel lorsqu\'un objet correspondant à votre recherche est publié.',
    icon: BellAlertIcon,
  },
  {
    name: 'Communauté solidaire',
    description: 'Rejoignez une communauté bienveillante dédiée à s\'entraider pour retrouver les objets perdus.',
    icon: HandRaisedIcon,
  },
];

const stats = [
  { id: 1, name: 'Objets retrouvés', value: '2,000+' },
  { id: 2, name: 'Utilisateurs actifs', value: '15,000+' },
  { id: 3, name: 'Taux de succès', value: '85%' },
];

export default function Home() {
  return (
    <div className="flex flex-col">
      {/* Hero Section */}
      <div className="relative bg-gray-50">
        <div className="container mx-auto px-4 py-12 flex flex-col md:flex-row items-center">
          <div className="md:w-1/2 mb-8 md:mb-0">
            <h1 className="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
              Retrouvez vos objets perdus
              <span className="text-blue-600"> simplement</span>
            </h1>
            <p className="text-xl text-gray-600 mb-6">
              Une plateforme moderne et efficace pour publier et retrouver des objets perdus ou trouvés.
              Rejoignez notre communauté et donnez une seconde chance aux objets égarés.
            </p>
            <div className="flex gap-4">
              <Link
                to="/lost"
                className="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 flex items-center gap-x-2"
              >
                J'ai perdu un objet
                <ArrowRightIcon className="h-4 w-4" />
              </Link>
              <Link
                to="/found"
                className="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700"
              >
                J'ai trouvé un objet
              </Link>
            </div>
          </div>
          <div className="md:w-1/2">
            <img 
              src="https://images.unsplash.com/photo-1586769852044-692d6e3703f0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
              alt="Lost and Found" 
              className="w-full h-auto max-h-[400px] object-cover rounded-lg shadow-lg"
            />
          </div>
        </div>
      </div>

      {/* Feature section */}
      <div className="py-24 sm:py-32">
        <div className="mx-auto max-w-7xl px-6 lg:px-8">
          <div className="mx-auto max-w-2xl lg:text-center">
            <h2 className="text-base font-semibold leading-7 text-blue-600">Plus efficace</h2>
            <p className="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
              Tout ce dont vous avez besoin pour retrouver vos objets
            </p>
            <p className="mt-6 text-lg leading-8 text-gray-600">
              Notre plateforme offre tous les outils nécessaires pour maximiser vos chances de retrouver vos objets perdus
              ou de les restituer à leurs propriétaires.
            </p>
          </div>
          <div className="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
            <dl className="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
              {features.map((feature) => (
                <div key={feature.name} className="flex flex-col">
                  <dt className="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                    <feature.icon className="h-5 w-5 flex-none text-blue-600" aria-hidden="true" />
                    {feature.name}
                  </dt>
                  <dd className="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                    <p className="flex-auto">{feature.description}</p>
                  </dd>
                </div>
              ))}
            </dl>
          </div>
        </div>
      </div>

      {/* Stats section */}
      <div className="relative isolate overflow-hidden bg-gray-900 py-24 sm:py-32">
        <div className="mx-auto max-w-7xl px-6 lg:px-8">
          <div className="mx-auto max-w-2xl lg:max-w-none">
            <div className="text-center">
              <h2 className="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                Faites confiance à notre communauté
              </h2>
              <p className="mt-4 text-lg leading-8 text-gray-300">
                Des milliers d'utilisateurs nous font confiance pour retrouver leurs objets perdus
              </p>
            </div>
            <dl className="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-3">
              {stats.map((stat) => (
                <div key={stat.id} className="flex flex-col bg-white/5 p-8">
                  <dt className="text-sm font-semibold leading-6 text-gray-300">{stat.name}</dt>
                  <dd className="order-first text-3xl font-semibold tracking-tight text-white">{stat.value}</dd>
                </div>
              ))}
            </dl>
          </div>
        </div>
      </div>

      {/* CTA section */}
      <div className="relative isolate overflow-hidden bg-white">
        <div className="px-6 py-24 sm:px-6 sm:py-32 lg:px-8">
          <div className="mx-auto max-w-2xl text-center">
            <h2 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
              Prêt à retrouver vos objets perdus ?
              <br />
              Commencez dès maintenant
            </h2>
            <p className="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600">
              Inscrivez-vous gratuitement et rejoignez notre communauté pour publier ou rechercher des objets perdus.
            </p>
            <div className="mt-10 flex items-center justify-center gap-x-6">
              <Link
                to="/register"
                className="btn btn-primary"
              >
                Créer un compte
              </Link>
              <Link
                to="/login"
                className="btn btn-secondary"
              >
                Se connecter
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
