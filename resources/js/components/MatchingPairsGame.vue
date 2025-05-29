<template>
    <div class="matching-pairs-game">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold mb-4">Find the Danish-English pairs</h2>
            <div class="flex justify-center items-center gap-4 mb-4">
                <div class="bg-gray-200 rounded-full h-3 w-64 relative">
                    <div 
                        class="bg-green-500 rounded-full h-3 absolute left-0 top-0 transition-all duration-300"
                        :style="`width: ${progressPercentage}%`"
                    ></div>
                </div>
                <span class="text-lg font-semibold">{{ matchedPairs }} / {{ totalPairs }}</span>
            </div>
        </div>

        <div v-if="!gameCompleted" class="grid grid-cols-4 gap-4 max-w-2xl mx-auto">
            <div
                v-for="(card, index) in cards"
                :key="index"
                @click="flipCard(index)"
                class="card-container"
                :class="{ 'pointer-events-none': card.matched || flippedCards.length === 2 }"
            >
                <div 
                    class="card"
                    :class="{ 
                        'flipped': card.flipped || card.matched,
                        'matched': card.matched 
                    }"
                >
                    <div class="card-front bg-blue-500 hover:bg-blue-600 transition-colors cursor-pointer">
                        <span class="text-white text-2xl">?</span>
                    </div>
                    <div class="card-back" :class="card.matched ? 'bg-green-100' : 'bg-white'">
                        <span class="text-lg font-medium">{{ card.text }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div v-else class="text-center">
            <div class="mb-8">
                <div class="text-6xl mb-4">⭐</div>
                <h3 class="text-3xl font-bold mb-2">Well done!</h3>
                <p class="text-xl text-gray-600">You found all {{ totalPairs }} pairs!</p>
            </div>
            <div class="flex gap-4 justify-center">
                <button 
                    @click="resetGame"
                    class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
                >
                    Play Again
                </button>
                <a 
                    href="/games"
                    class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors inline-block"
                >
                    Return Home
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            wordPairs: [
                { danish: 'Hej', english: 'Hello' },
                { danish: 'Far', english: 'Father' },
                { danish: 'Mor', english: 'Mother' },
                { danish: 'Barn', english: 'Child' },
                { danish: 'Hund', english: 'Dog' },
                { danish: 'Kat', english: 'Cat' },
                { danish: 'Hus', english: 'House' },
                { danish: 'Mad', english: 'Food' }
            ],
            cards: [],
            flippedCards: [],
            matchedPairs: 0,
            gameCompleted: false
        };
    },
    computed: {
        totalPairs() {
            return this.wordPairs.length;
        },
        progressPercentage() {
            return (this.matchedPairs / this.totalPairs) * 100;
        }
    },
    mounted() {
        this.initializeGame();
    },
    methods: {
        initializeGame() {
            // Create cards array with both Danish and English words
            const allCards = [];
            this.wordPairs.forEach((pair, index) => {
                allCards.push({
                    id: `danish-${index}`,
                    text: pair.danish,
                    pairId: index,
                    language: 'danish',
                    flipped: false,
                    matched: false
                });
                allCards.push({
                    id: `english-${index}`,
                    text: pair.english,
                    pairId: index,
                    language: 'english',
                    flipped: false,
                    matched: false
                });
            });
            
            // Shuffle the cards
            this.cards = this.shuffleArray(allCards);
        },
        
        shuffleArray(array) {
            const shuffled = [...array];
            for (let i = shuffled.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
            }
            return shuffled;
        },
        
        flipCard(index) {
            const card = this.cards[index];
            
            // Don't flip if already flipped or matched
            if (card.flipped || card.matched || this.flippedCards.length === 2) {
                return;
            }
            
            // Flip the card
            card.flipped = true;
            this.flippedCards.push(index);
            
            // Check for match when two cards are flipped
            if (this.flippedCards.length === 2) {
                this.checkForMatch();
            }
        },
        
        checkForMatch() {
            const [index1, index2] = this.flippedCards;
            const card1 = this.cards[index1];
            const card2 = this.cards[index2];
            
            if (card1.pairId === card2.pairId && card1.language !== card2.language) {
                // Match found!
                setTimeout(() => {
                    card1.matched = true;
                    card2.matched = true;
                    this.matchedPairs++;
                    this.flippedCards = [];
                    
                    // Check if game is completed
                    if (this.matchedPairs === this.totalPairs) {
                        setTimeout(() => {
                            this.gameCompleted = true;
                        }, 500);
                    }
                }, 500);
            } else {
                // No match - flip cards back
                setTimeout(() => {
                    card1.flipped = false;
                    card2.flipped = false;
                    this.flippedCards = [];
                }, 1000);
            }
        },
        
        resetGame() {
            this.matchedPairs = 0;
            this.flippedCards = [];
            this.gameCompleted = false;
            this.initializeGame();
        }
    }
};
</script>

<style scoped>
.card-container {
    perspective: 1000px;
    height: 100px;
}

.card {
    width: 100%;
    height: 100%;
    position: relative;
    transform-style: preserve-3d;
    transition: transform 0.3s;
}

.card.flipped {
    transform: rotateY(180deg);
}

.card-front,
.card-back {
    width: 100%;
    height: 100%;
    position: absolute;
    backface-visibility: hidden;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #e5e7eb;
}

.card-back {
    transform: rotateY(180deg);
}

.card.matched .card-back {
    border-color: #10b981;
}
</style>