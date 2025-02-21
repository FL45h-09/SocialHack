import NextAuth from "next-auth";
import CredentialsProvider from "next-auth/providers/credentials";
import bcrypt from "bcrypt";

const users = [
  {
    id: "1",
    name: "John Doe",
    email: "john@example.com",
    password: bcrypt.hashSync("password123", 10), // Pre-hashed password
  }
];

export const authOptions = {
  providers: [
    CredentialsProvider({
      name: "Credentials",
      credentials: {
        email: { label: "Email", type: "email", placeholder: "user@example.com" },
        password: { label: "Password", type: "password" }
      },
      async authorize(credentials) {
        if (!credentials?.email || !credentials?.password) {
          throw new Error("Email and password are required");
        }

        // Find user in array
        const user = users.find(user => user.email === credentials.email);
        if (!user) {
          throw new Error("User not found");
        }

        // Check password
        const isValid = await bcrypt.compare(credentials.password, user.password);
        if (!isValid) {
          throw new Error("Invalid password");
        }

        return { id: user.id, name: user.name, email: user.email };
      }
    })
  ],
  session: {
    strategy: "jwt"
  },
  pages: {
    signIn: "/login"
  }
};

const handler = NextAuth(authOptions);
export { handler as GET, handler as POST };
