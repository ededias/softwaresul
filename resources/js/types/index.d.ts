export interface User {
    id: number;
    name: string;
    email: string;
    role: string;
    email_verified_at?: string;
}
export interface Book {
    id: number;
    title: string;
    author: string;
    description: string;
    year: number;
    isbn: string;
    genre: number;
    created_at: string;
    image: string;
    quantity: number;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    },
    book: Book;
    books: Book[];
};
