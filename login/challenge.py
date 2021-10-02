import sqlite3

from hacksport.problem import files_from_directory, PHPApp, ProtectedFile


class Problem(PHPApp):
    files = files_from_directory("webroot/") + [ProtectedFile("users.db")]
    php_root = "webroot/"
    num_workers = 5

    def setup(self):
        conn = sqlite3.connect("users.db")
        conn.cursor().execute("PRAGMA journal_mode = MEMORY")
        conn.commit()
        
        c = conn.cursor()
        c.execute("CREATE TABLE users (name text, password text, admin integer, question text, answer text);")

        # This is static. However, there is no reason it couldn't be autogenerated!
        c.execute(
            """INSERT INTO users VALUES ('ndoe', 'nFTHEHhMM2RNacEp', 1, 'What is the name of your hometown?', 'Springfield')"""
        )

        conn.commit()
        conn.close()